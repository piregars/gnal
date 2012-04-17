<?php

namespace Gnal\Bundle\CoreBundle\Controller;

use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Gnal\Bundle\CoreBundle\Brain\NeuralNet;
use Gnal\Bundle\CoreBundle\Brain\NeuronLayer;
use Gnal\Bundle\CoreBundle\Brain\Neuron;

class CoreController extends ContainerAware
{
    /**
     * @Route("/")
     * @Template()
     */
    public function indexAction()
    {
        $net = $this->container->get('brain')->createNeuralNetwork(array(2, 3, 1));

        $net->train(array(0, 1));

        // $nLayer = new NeuronLayer();

        // $nLayer
        //     ->addNeuron(new Neuron(9))
        //     ->addNeuron(new Neuron(9))
        // ;
        // $nNet->addNeuronLayer($nLayer);

        // do {
        //     $set = array();
            
        //     for ($i=0; $i < 9; $i++) { 
        //         $set['x'][] = mt_rand(0,1);
        //     }

        //     if (array(0,1,0,1,1,1,0,1,0) === $set['x']) $set['target'] = true;

        //     $result = $nNet->feed($set);
        // } while ($result !== true);

        // die(print_r($results));

        // $x = array(0,1,0,1,1,1,0,1,0);
        // $w = array(0,1,0,1,1,1,0,1,0);
        // $activation = 0;

        // for ($i=0; $i < count($x); $i++) { 
        //     $activation += $x[$i] * $w[$i];
        // }

        // var_dump($activation);

        return array('network' => $net);
    }
}
