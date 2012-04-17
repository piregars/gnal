<?php

namespace Gnal\Bundle\AnnBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

use Gnal\Bundle\AnnBundle\Entity\Layer;

/**
 * @ORM\Table(name="ann_network")
 * @ORM\Entity
 */
class Network
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column()
     */
    protected $name;

    /**
     * @ORM\OneToMany(targetEntity="Layer", mappedBy="network", cascade={"persist"})
     */
    protected $layers;

    /**
     * @ORM\Column(type="integer")
     */
    protected $epochs = 0;

    public function __construct(array $nbsNeurons)
    {
        $this->layers = new ArrayCollection();
        $i = 0;
        $nbWeights = 0;

        foreach ($nbsNeurons as $nbNeurons) {
            if ($i > 0) {
                $layer = new Layer($nbNeurons, $nbWeights);
                $layer->setNetwork($this);
                $this->layers[] = $layer;
            }
            $nbWeights = $nbNeurons;
            $i++;
        }
    }

    public function propagateForward(array $input)
    {
        $output = array();
        $i = 0;
        $this->epochs++;
        echo '-----------<br>';
        foreach ($this->layers as $layer) {
            foreach ($layer->getNeurons() as $neuron) {
                $in = $i === 0 ? $input : $output[$i-1];

                $out = $neuron->process($in);

                $output[$i][] = $out;
            }
            $i++;
            echo '-----------<br>';
        }
    }

    public function propagateBackward($expectedOutput)
    {
        $l = $this->layers->count() - 1;
        $deltas = array();
        $errorFactors = array();

        for ($i=$l; $i >= 0; $i--) {
            foreach ($this->layers[$i]->getNeurons() as $neuron) {
                if ($i === $l) {
                    $delta = $neuron->calcDelta($neuron->calcOutputNeuronErrorFactor($expectedOutput));
                    $deltas[$i][] = $delta;
                    $neuron->setDelta($delta);
                } else {
                    $delta = $neuron->calcDelta($neuron->calcHiddenNeuronErrorFactor($deltas[$i+1]));
                    $deltas[$i][] = $delta;
                    $neuron->setDelta($delta);
                }

                foreach ($neuron->getSynapses() as $synapse) {
                    $newWeight = $neuron->calcWeight($delta, $synapse->getWeight(), $synapse->getInput());
                    $newBias = $neuron->calcBias($delta);

                    $synapse->setWeight($newWeight);
                    $neuron->setBias($newBias);
                    $errorFactors[$i][] = $delta * $newWeight;
                }
            }
        }
    }

    public function train(array $trainingSet)
    {
        $this->propagateForward($trainingSet['input']);
        $this->propagateBackward($trainingSet['expectedOutput']);
    }    

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }
    
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }
}
