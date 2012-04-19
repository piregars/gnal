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

        $trainingSets[0] = array('inputs' => array(1, 0), 'targets' => array(1));
        $trainingSets[1] = array('inputs' => array(1, 1), 'targets' => array(0));
        $trainingSets[2] = array('inputs' => array(0, 0), 'targets' => array(0));
        $trainingSets[3] = array('inputs' => array(0, 1), 'targets' => array(1));
        $wins = 0;
        $start = microtime(true);
        for ($i=0; $i < 100000; $i++) {
            $key = mt_rand(0, 3);
            $network->train($trainingSets[$key]);
            if ($wins > 1000) break;

            // Now output some stuff
            $output->writeln('Training... epochs: '.$network->getAge());
            $inputs = $network->getInputs();
            $outputs = $network->getOutputs();
            $output->writeln('Inputs: '.$inputs[0].' '.$inputs[1]);

            foreach ($outputs as $k => $v) {
                $outputs[$k] = round($v);
            }

            if ($outputs == $trainingSets[$key]['targets']) {
                $wins++;
                $output->writeln('<question>Outputs: '.round($outputs[0]).'</question>');
            } else {
                $wins = 0;
                $output->writeln('<error>Outputs: '.round($outputs[0]).'</error>');
            }
            $output->writeln('------------------');
        }
        $exectime = microtime(true) - $start;

        // $em->persist($network);
        // $em->flush();

        $output->writeln('Exec time: '.round($exectime).' sec');
    }
}