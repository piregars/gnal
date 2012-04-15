<?php

namespace Gnal\Bundle\LanguageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Table(name="language_connotation")
 * @ORM\Entity
 */
class Connotation
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(unique="true")
     */
    protected $name;

    /**
     * @ORM\ManyToMany(targetEntity="Lemma", mappedBy="connotations")
     */
    private $lemmas;

    public function __construct()
    {
        $this->lemmas = new ArrayCollection;
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

    public function addLemma($lemma)
    {
        $this->lemmas[] = $lemma;
    
        return $this;
    }
    
    public function getLemmas()
    {
        return $this->lemmas;
    }
}
