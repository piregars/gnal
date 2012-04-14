<?php

namespace Gnal\Bundle\LanguageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Table(name="language_behavior")
 * @ORM\Entity
 */
class Behavior
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="LexicalCategory", mappedBy="behaviors")
     */
    protected $lexicalCategory;

    /**
     * @ORM\OneToMany(targetEntity="Lemma", mappedBy="definitions")
     */
    protected $lemma;

    /**
     * @ORM\OneToMany(targetEntity="Definition", mappedBy="lemma")
     */
    protected $definitions;

    public function getLexicalCategory()
    {
        return $this->lexicalCategory;
    }
    
    public function setLexicalCategory($lexicalCategory)
    {
        $this->lexicalCategory = $lexicalCategory;
    
        return $this;
    }

    public function getLemma()
    {
        return $this->lemma;
    }
    
    public function setLemma($lemma)
    {
        $this->lemma = $lemma;
    
        return $this;
    }
}
