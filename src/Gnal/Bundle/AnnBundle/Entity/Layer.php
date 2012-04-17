<?php
//
namespace Gnal\Bundle\AnnBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Table(name="ann_layer")
 * @ORM\Entity
 */
class Layer
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Network", inversedBy="layers")
     */
    protected $network;

    /**
     * @ORM\OneToMany(targetEntity="Neuron", mappedBy="layer", cascade={"persist"})
     */
    protected $neurons;

    public function __construct($nbNeurons, $nbWeights)
    {
        $neurons = new ArrayCollection();

        for ($i=0; $i < $nbNeurons; $i++) {
            $neuron = new Neuron($nbWeights);
            $neuron->setLayer($this);
            $this->neurons[] = $neuron;
        }
    }

    public function addNeuron($neuron)
    {
        $this->neurons[] = $neuron;
    
        return $this;
    }
    
    public function getNeurons()
    {
        return $this->neurons;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNetwork()
    {
        return $this->network;
    }
    
    public function setNetwork($network)
    {
        $this->network = $network;
    
        return $this;
    }
}
