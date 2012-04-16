<?php

namespace Gnal\Component\NeuralNetwork;

use Gnal\Component\NeuralNetwork\Neuron;

class Layer
{
    private $neurons = array();

    public function __construct($nbNeurons, $prevNbNeurons)
    {
        for ($i=0; $i < $nbNeurons; $i++) {
            $this->neurons[] = new Neuron($prevNbNeurons);
        }
    }

    public function getNeurons()
    {
        return $this->neurons;
    }
}
