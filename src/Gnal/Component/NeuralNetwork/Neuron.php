<?php

namespace Gnal\Component\NeuralNetwork;

class Neuron
{
    private $weights = array();

    public function __construct($nbWeights)
    {
        for ($i=0; $i < $nbWeights; $i++) { 
            $this->weights[] = mt_rand(1, 999) / 1000;
        }
    }

    public function getWeights()
    {
        return $this->weights;
    }
}
