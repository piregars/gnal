<?php

namespace Gnal\Component\NeuralNetwork;

use Gnal\Component\NeuralNetwork\Neuron;

class Layer
{
    private $neurons = array();

    public function __construct($nbNeurons, $nbWeights)
    {
        for ($i=0; $i < $nbNeurons; $i++) {
            $this->neurons[] = new Neuron($nbWeights);
        }
    }

    public function getNeurons()
    {
        return $this->neurons;
    }
}
