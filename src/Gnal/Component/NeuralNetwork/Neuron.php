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

    public function process($input)
    {
        $i=0;
        $activation = 0;
        $theta = 0.5;
        foreach ($this->weights as $weight) {
            $activation += $input[$i] * $weight;
            echo 'in: '.$input[$i].'<br>';
            $i++;
        }

        $output = $activation >= $theta ? 1 : 0;
        echo ('<strong>output</strong>: '.$output.'<br>');
        return $output;
    }

    public function getWeights()
    {
        return $this->weights;
    }
}
