<?php

namespace Gnal\Bundle\AnnBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Table(name="ann_neuron")
 * @ORM\Entity
 */
class Neuron
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Layer", inversedBy="neurons")
     */
    protected $layer;

    /**
     * @ORM\OneToMany(targetEntity="Synapse", mappedBy="neuron", cascade={"persist"})
     */
    protected $synapses;

    /**
     * @ORM\Column(type="float")
     */
    protected $bias;

    protected $output;

    protected $delta;

    public function __construct($nbWeights)
    {
        $synapses = new ArrayCollection();
        $this->bias = mt_rand(1, 999) / 1000;

        for ($i=0; $i < $nbWeights; $i++) {
            $synapse = new Synapse();
            $synapse->setNeuron($this);
            $this->synapses[] = $synapse;
        }
    }

    public function process($input)
    {
        $i=0;
        $activation = $this->bias;
        foreach ($this->synapses as $synapse) {
            $synapse->setInput($input[$i]);
            $activation += $synapse->getInput() * $synapse->getWeight();
            $i++;
        }

        $output = $this->sigmoid($activation);
        $this->output = $output;

        return $output;
    }

    public function sigmoid($val)
    {
        return 1 / (1 + exp(-1 * $val));
    }

    public function calcDelta($errorFactor)
    {
        return $this->output * (1 - $this->output) * $errorFactor;
    }

    public function calcNewBias($learnRate, $delta)
    {
        return $this->bias + $learnRate * 1 * $delta;
    }

    public function calcNewWeight($learnRate, $delta, $oldWeight, $input)
    {
        return $oldWeight + $learnRate * 1 * $delta * $input;
    }

    public function getLayer()
    {
        return $this->layer;
    }
    
    public function setLayer($layer)
    {
        $this->layer = $layer;
    
        return $this;
    }

    public function getBias()
    {
        return $this->bias;
    }
    
    public function setBias($bias)
    {
        $this->bias = $bias;
    
        return $this;
    }

    public function getOutput()
    {
        return $this->output;
    }
    
    public function setOutput($output)
    {
        $this->output = $output;
    
        return $this;
    }

    public function getDelta()
    {
        return $this->delta;
    }
    
    public function setDelta($delta)
    {
        $this->delta = $delta;
    
        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function addSynapse($synapse)
    {
        $this->synapses[] = $synapse;
    }
    
    public function getSynapses()
    {
        return $this->synapses;
    }
}
