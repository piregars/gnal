<?php

namespace Gnal\Component\NeuralNetwork;

use Gnal\Component\NeuralNetwork\Layer;

class Network
{
    private $layers = array();

    public function __construct(array $nbsNeurons)
    {
        $i = 0;
        $nbWeights = 0;
        foreach ($nbsNeurons as $nbNeurons) {
            if ($i > 0) {
                $this->layers[] = new Layer($nbNeurons, $nbWeights);
            }
            $nbWeights = $nbNeurons;
            $i++;
        }
    }

    public function run(array $input)
    {
        $output = array();
        $i = 0;
        echo '-----------<br>';
        foreach ($this->layers as $layer) {
            foreach ($layer->getNeurons() as $neuron) {
                $in = $i === 0 ? $input : $output[$i-1];

                $out = $neuron->process($in);

                $output[$i][] = $out;

                // $y = $this->sigma($sum+1);
                // var_dump($y);
                // $output[] = $y >= 0.8 ? 1 : 0;
                // $output[$l + 1][] = $this->sigma($sum+1);
            }
            $i++;
            echo '-----------<br>';
        }
        die();
    }

    public function train(array $input)
    {
        $this->run($input);
    }

    public function getLayers()
    {
        return $this->layers;
    }
}
