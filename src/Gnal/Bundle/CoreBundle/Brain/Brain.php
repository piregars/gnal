<?php

namespace Gnal\Bundle\CoreBundle\Brain;

use Gnal\Component\NeuralNetwork\Network;

class Brain
{
    public function createNeuralNetwork(array $nbsNeurons)
    {
        return new Network($nbsNeurons);
    }
}
