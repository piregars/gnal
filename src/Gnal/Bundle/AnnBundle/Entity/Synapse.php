<?php

namespace Gnal\Bundle\AnnBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Table(name="ann_synapse")
 * @ORM\Entity
 */
class Synapse
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="float")
     */
    protected $weight;

    /**
     * @ORM\ManyToOne(targetEntity="Neuron", inversedBy="synapses")
     */
    protected $neuron;

    protected $input;

    public function __construct()
    {
        $this->weight = mt_rand(1, 999) / 1000;
    }

    public function getId()
    {
        return $this->id;
    }
    
    public function getWeight()
    {
        return $this->weight;
    }
    
    public function setWeight($weight)
    {
        $this->weight = $weight;
    
        return $this;
    }

    public function getInput()
    {
        return $this->input;
    }
    
    public function setInput($input)
    {
        $this->input = $input;
    
        return $this;
    }

    public function getNeuron()
    {
        return $this->neuron;
    }
    
    public function setNeuron($neuron)
    {
        $this->neuron = $neuron;
    
        return $this;
    }
}
