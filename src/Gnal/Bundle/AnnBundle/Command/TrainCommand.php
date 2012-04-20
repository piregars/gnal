<?php

namespace Gnal\Bundle\AnnBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class TrainCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this->setName('ann:train');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $em = $this->getContainer()->get('doctrine')->getEntityManager();
        $network = $em->getRepository('GnalAnnBundle:Network')->findOneBy(array('id' => 1));
        // a b c d e f g h i j k l m n o p q r s t u v w x y z
        $trainingSet = array('inputs' => array(),'targets' => array());
        
        $wins = 0;
        $start = microtime(true);
        for ($i=0; $i < 1000000; $i++) {
            $trainingSet['inputs'][0] = mt_rand(0, 4)/4;
            $trainingSet['inputs'][1] = mt_rand(0, 4)/4;
            $trainingSet['inputs'][2] = mt_rand(0, 4)/4;
            $trainingSet['targets'][0] = 0;

            // bed
            if (
                $trainingSet['inputs'] == array(1/4, 4/4, 3/4) ||
                $trainingSet['inputs'] == array(2/4, 4/4, 3/4) ||
                $trainingSet['inputs'] == array(3/4, 4/4, 3/4) ||
                $trainingSet['inputs'] == array(4/4, 4/4, 3/4)
            ) {
                $trainingSet['targets'][0] = 1;
            }
            // die(print_r($trainingSet));
            $network->train($trainingSet);
            // if ($wins > 50000) break;

            // Now output some stuff
            $output->writeln('Training... epochs: '.$network->getAge());
            $inputs = $network->getInputs();
            $outputs = $network->getOutputs();

            // $res = array_keys($trainingSets);
            
            // $output->writeln('Inputs: '.$res[$key]);

            foreach ($outputs as $k => $v) {
                $outputs[$k] = round($v);
            }

            if ($outputs == $trainingSet['targets']) {
                $wins++;
                $output->writeln('<question>Outputs: '.round($outputs[0]).'</question>');
            } else {
                $output->writeln('<error>Outputs: '.round($outputs[0]).'</error>');
            }
            $winRate = 100*$wins/($i+1);
            $output->writeln('Success rate: '.$winRate);
            $output->writeln('------------------');
        }
        $exectime = microtime(true) - $start;

        $em->persist($network);
        $em->flush();

        $output->writeln('Exec time: '.round($exectime).' sec');
    }
}
