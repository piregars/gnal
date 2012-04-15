<?php

namespace Gnal\Bundle\LanguageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Table(name="language_lexeme")
 * @ORM\Entity
 */
class Lexeme
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
     * @ORM\ManyToOne(targetEntity="Lemma", inversedBy="lexemes")
     */
    protected $lemma;

    /**
     * @ORM\Column(nullable="true")
     */
    protected $tense;

    public function getName()
    {
        return $this->name;
    }
    
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    public function getTense()
    {
        return $this->tense;
    }
    
    public function setTense($tense)
    {
        $this->tense = $tense;
    
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

    public function getId()
    {
        return $this->id;
    }
}
