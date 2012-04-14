<?php

namespace Gnal\Bundle\LanguageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Table(name="language_word")
 * @ORM\Entity
 */
class Word
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
     * @ORM\ManyToOne(targetEntity="Lemma", inversedBy="lexeme")
     */
    protected $lemma;

    /**
     * @ORM\Column(nullable="true")
     */
    protected $tense;

    /**
     * @ORM\ManyToOne(targetEntity="Language", inversedBy="words")
     */
    protected $language;

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
}
