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
