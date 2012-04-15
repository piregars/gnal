<?php

namespace Gnal\Bundle\LanguageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Table(name="language_lexical_category")
 * @ORM\Entity
 */
class LexicalCategory
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
     * @ORM\OneToMany(targetEntity="Lemma", mappedBy="lexicalCategory")
     */
    protected $lemmas;

    public function __construct()
    {
        $this->lemmas = new ArrayCollection;
    }

    public function __toString()
    {
        return $this->name;
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
