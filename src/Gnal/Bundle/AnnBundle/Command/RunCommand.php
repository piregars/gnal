<?php

namespace Gnal\Bundle\AnnBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class RunCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this->setName('ann:run');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $em = $this->getContainer()->get('doctrine')->getEntityManager();
        $network = $em->getRepository('GnalAnnBundle:Network')->findOneBy(array('id' => 1));

        $letters = array(
            0 => 0/25,
            1 => 1/25,
            2 => 2/25,
            3 => 3/25,
            4 => 4/25,
            5 => 5/25,
            6 => 6/25,
            7 => 7/25,
            8 => 8/25,
            9 => 9/25,
            10 => 10/25,
            11 => 11/25,
            12 => 12/25,
            13 => 13/25,
            14 => 14/25,
            15 => 15/25,
            16 => 16/25,
            17 => 17/25,
            18 => 18/25,
            19 => 19/25,
            20 => 20/25,
            21 => 21/25,
            22 => 22/25,
            23 => 23/25,
            24 => 24/25,
            25 => 25/25
        );
        $alphabet = array( 0 => 'a', 1 => 'b', 2 => 'c', 3 => 'd', 4 => 'e', 5 => 'f', 6 => 'g', 7 => 'h', 8 => 'i', 9 => 'j', 10 => 'k', 11 => 'l', 12 => 'm', 13 => 'n', 14 => 'o', 15 => 'p', 16 => 'q', 17 => 'r', 18 => 's', 19 => 't', 20 => 'u', 21 => 'v', 22 => 'w', 23 => 'x', 24 => 'y', 25 => 'z');
        $wins = 0;
        $start = microtime(true);
        for ($i=0; $i < 1; $i++) {
            $in1 = mt_rand(0, 25);
            $in2 = mt_rand(0, 25);
            $in3 = mt_rand(0, 25);
            $trainingSet['inputs'][0] = $letters[1];
            $trainingSet['inputs'][1] = $letters[4];
            $trainingSet['inputs'][2] = $letters[3];
            $trainingSet['targets'][0] = 1;

            // bed
            if (
                $trainingSet['inputs'] == array(1/4, 4/4, 3/4) ||
                $trainingSet['inputs'] == array(2/4, 4/4, 3/4) ||
                $trainingSet['inputs'] == array(3/4, 4/4, 3/4) ||
                $trainingSet['inputs'] == array(4/4, 4/4, 3/4)
            ) {
                $trainingSet['targets'][0] = 1;
            }
            
            $network->run($trainingSet['inputs']);
            // if ($wins > 50000) break;

            // Now output some stuff
            $output->writeln('Training... epochs: '.$network->getAge());
            $inputs = $network->getInputs();
            $outputs = $network->getOutputs();

            // $res = array_keys($trainingSets);
            
            $output->writeln('Inputs: '.$alphabet[1].$alphabet[4].$alphabet[3]);

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

        $output->writeln('Exec time: '.round($exectime).' sec');
    }
}
