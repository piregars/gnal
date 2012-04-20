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
        
        $trainingSets = array();
        $trainingSets[] = array('inputs' => array($network->scale(mt_rand(0,25),25),1, $network->scale(0,13),1,$network->scale(0,13)), 'targets' => array(0));
        $trainingSets[] = array('inputs' => array($network->scale(mt_rand(0,25),25),0, $network->scale(0,13),1,$network->scale(0,13)), 'targets' => array(1));
        $trainingSets[] = array('inputs' => array($network->scale(mt_rand(0,25),25),1, $network->scale(0,13),0,$network->scale(0,13)), 'targets' => array(0));
        $trainingSets[] = array('inputs' => array($network->scale(mt_rand(0,25),25),1, $network->scale(mt_rand(1,11),13),0,$network->scale(mt_rand(1,11),13)), 'targets' => array(0));
        $trainingSets[] = array('inputs' => array($network->scale(mt_rand(0,25),25),1, $network->scale(mt_rand(1,11),13),1,$network->scale(mt_rand(1,11),13)), 'targets' => array(0));
        $trainingSets[] = array('inputs' => array($network->scale(mt_rand(0,25),25),1, $network->scale(mt_rand(1,11),13),0,$network->scale(mt_rand(1,11),13)), 'targets' => array(0));
        $trainingSets[] = array('inputs' => array($network->scale(mt_rand(0,25),25),1, $network->scale(12,13),1,$network->scale(12,13)), 'targets' => array(0));
        $trainingSets[] = array('inputs' => array($network->scale(mt_rand(0,25),25),0, $network->scale(12,13),1,$network->scale(12,13)), 'targets' => array(1));
        $trainingSets[] = array('inputs' => array($network->scale(mt_rand(0,25),25),1, $network->scale(12,13),0,$network->scale(12,13)), 'targets' => array(1));
        $trainingSets[] = array('inputs' => array($network->scale(mt_rand(0,25),25),1, $network->scale(mt_rand(1,11),13),0,$network->scale(mt_rand(1,11),13)), 'targets' => array(0));
        $trainingSets[] = array('inputs' => array($network->scale(mt_rand(0,25),25),1, $network->scale(mt_rand(1,11),13),1,$network->scale(mt_rand(1,11),13)), 'targets' => array(0));
        $trainingSets[] = array('inputs' => array($network->scale(mt_rand(0,25),25),1, $network->scale(13,13),1,$network->scale(13,13)), 'targets' => array(1));
        $trainingSets[] = array('inputs' => array($network->scale(mt_rand(0,25),25),1, $network->scale(13,13),0,$network->scale(13,13)), 'targets' => array(0));
        $trainingSets[] = array('inputs' => array($network->scale(mt_rand(0,25),25),1, $network->scale(mt_rand(1,11),13),1,$network->scale(mt_rand(1,11),13)), 'targets' => array(0));
        
        $wins = 0;
        $start = microtime(true);
        for ($i=0; $i < 100000; $i++) {
            $key = mt_rand(013);
            $network->train($trainingSets[$key]);
            // if ($wins > 50000) break;

            // Now output some stuff
            $output->writeln('Training... epochs: '.$network->getAge());
            $inputs = $network->getInputs();
            $outputs = $network->getOutputs();

            $res = array_keys($trainingSets);
            
            $output->writeln('Inputs: '.$res[$key]);

            foreach ($outputs as $k => $v) {
                $outputs[$k] = round($v);
            }

            if ($outputs == $trainingSets[$key]['targets']) {
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
