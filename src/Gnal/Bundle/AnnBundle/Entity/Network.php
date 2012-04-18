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
    protected $age = 0;

    /**
     * @ORM\Column(type="float", name="learning_rate")
     */
    protected $learningRate = 0.5;

    protected $output;

    protected $input;

    public function __construct(array $params)
    {
        $this->layers = new ArrayCollection();

        $i = 0;
        foreach ($params as $nbNeurons) {
            if ($i > 0) {
                $layer = new Layer($nbNeurons, $nbSynapses);
                $layer->setNetwork($this);
                $this->layers[] = $layer;
            }
            $nbSynapses = $nbNeurons;
            $i++;
        }
    }

    public function run(array $input)
    {
        $this->input = $input;
        $output = array();
        $i = 0;
        foreach ($this->layers as $layer) {
            foreach ($layer->getNeurons() as $neuron) {
                $in = $i === 0 ? $input : $output[$i-1];

                $out = $neuron->process($in);

                $output[$i][] = $out;
            }
            $i++;
        }
        $this->output = $out;
    }

    public function learn($expectedOutput)
    {
        $l = $this->layers->count() - 1;
        $errors = array();
        $this->age++;

        for ($i=$l; $i >= 0; $i--) {
            $errors[$i] = array();
            foreach ($this->layers[$i]->getNeurons() as $n => $neuron) {
                if ($i === $l) {
                    $delta = $neuron->calcDelta($expectedOutput - $neuron->getOutput());
                    $neuron->setDelta($delta);
                } else {
                    $delta = $neuron->calcDelta($errors[$i + 1][$n]);
                    $neuron->setDelta($delta);
                }

                $errors[$i] = array_fill(0, $neuron->getSynapses()->count(), 0);

                foreach ($neuron->getSynapses() as $s => $synapse) {
                    $newWeight = $neuron->calcNewWeight($this->learningRate, $delta, $synapse->getWeight(), $synapse->getInput());
                    $newBias = $neuron->calcNewBias($this->learningRate, $delta);

                    $synapse->setWeight($newWeight);
                    $neuron->setBias($newBias);

                    $errors[$i][$s] += $delta * $newWeight;
                }
            }
        }
    }

    public function train(array $trainingSet)
    {
        $this->run($trainingSet['input']);
        $this->learn($trainingSet['expectedOutput']);
    }    

    public function getId()
    {
        return $this->id;
    }

    public function addLayer($layer)
    {
        $this->layers[] = $layer;
    
        return $this;
    }
    
    public function getLayers()
    {
        return $this->layers;
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

    public function getAge()
    {
        return $this->age;
    }
    
    public function setAge($age)
    {
        $this->age = $age;
    
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

    public function getInput()
    {
        return $this->input;
    }
    
    public function setInput($input)
    {
        $this->input = $input;
    
        return $this;
    }

    public function getLearningRate()
    {
        return $this->learningRate;
    }
    
    public function setLearningRate($learningRate)
    {
        $this->learningRate = $learningRate;
    
        return $this;
    }
}
