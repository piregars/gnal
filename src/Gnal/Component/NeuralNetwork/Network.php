<?php

namespace Gnal\Component\NeuralNetwork;

use Gnal\Component\NeuralNetwork\Layer;

class Network
{
    private $nbInputs;

    private $nbOutputs;

    private $nbHiddenLayers;

    private $nbNeuronsPerHiddenLayers;

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

    public function feed($x)
    {
        $outputs = array();

        foreach ($this->neuronLayers as $layer) {
            foreach ($layer->getNeurons() as $neuron) {
                $a = 0;
                $w = $neuron->getWeights();

                for ($i=0; $i < $neuron->getNbInputs(); $i++) { 
                    $a += $x['inputs'][$i] * $w[$i];
                }
                // die(var_dump($a));
                if ($a + (-1 * $theta) >= 0) {
                    return true;
                } else {
                    return false;
                }
            }
        }
    }

    public function getLayers()
    {
        return $this->layers;
    }
}
