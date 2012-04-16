<?php

namespace Gnal\Component\NeuralNetwork;

use Gnal\Component\NeuralNetwork\Layer;

class Network
{
    private $layers = array();

    public function __construct(array $nbsNeurons)
    {
        $i = 0;
        $prevNbNeurons = 1;
        foreach ($nbsNeurons as $nbNeurons) {
            $this->layers[] = new Layer($nbNeurons, $prevNbNeurons);
            $prevNbNeurons = $nbNeurons;
            $i++;
        }
    }

    public function run($inputs)
    {
        $outputs = array();
        $l = 0;
        foreach ($this->layers as $layer) {
            foreach ($layer->getNeurons() as $neuron) {
                $x = $l === 0 ? $inputs : $outputs[$l];
                $i = 0;
                $sum = 0;
                foreach ($neuron->getWeights() as $weight) {
                    $sum += $weight * $x[$i];
                    $i++;
                }
                $outputs[$l + 1][] = $this->sigma($sum+1);
            }
            $l++;
        }
        die(print_r($outputs));
    }

    public function sigma($val)
    {
        return 1 / (1 + exp(-1 * $val));
    }

    public function train(array $inputs)
    {
        $this->run($inputs);
    }

    // public function train($x)
    // {
    //     $outputs = array();

    //     foreach ($this->neuronLayers as $layer) {
    //         foreach ($layer->getNeurons() as $neuron) {
    //             $a = 0;
    //             $w = $neuron->getWeights();

    //             for ($i=0; $i < $neuron->getNbInputs(); $i++) { 
    //                 $a += $x['inputs'][$i] * $w[$i];
    //             }
    //             // die(var_dump($a));
    //             if ($a + (-1 * $theta) >= 0) {
    //                 return true;
    //             } else {
    //                 return false;
    //             }
    //         }
    //     }
    // }

    public function getLayers()
    {
        return $this->layers;
    }
}
