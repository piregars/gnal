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

    public function __construct($nbWeights)
    {
        $synapses = new ArrayCollection();
        
        for ($i=0; $i < $nbWeights; $i++) {
            $synapse = new Synapse();
            $synapse->setNeuron($this);
            $this->synapses[] = $synapse;
        }
    }

    public function process($input)
    {
        $i=0;
        $activation = 0;
        $theta = 0.5;
        foreach ($this->synapses as $synapse) {
            $activation += $input[$i] * $synapse->getWeight();
            echo 'in: '.$input[$i].'<br>';
            $i++;
        }

        $output = $activation >= $theta ? 1 : 0;
        // $output = $this->sigma($activation);
        echo ('<strong>output</strong>: '.$output.'<br>');
        return $output;
    }

    public function sigma($val)
    {
        return 1 / (1 + exp(-1 * $val));
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

    public function getId()
    {
        return $this->id;
    }
}
