<?php

namespace Gnal\Bundle\CoreBundle\Brain;

class Neuron
{
    private $nbInputs;

    private $weights = array();

    public function __construct($nbInputs)
    {
        $this->nbInputs = $nbInputs;

        for ($i=0; $i < $this->nbInputs + 1; $i++) { 
            $this->weights[] = mt_rand();
        }
    }
}
