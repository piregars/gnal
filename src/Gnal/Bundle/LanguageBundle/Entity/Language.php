<?php

namespace Gnal\Bundle\LanguageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Table(name="language_language")
 * @ORM\Entity
 */
class Language
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
     * @ORM\OneToMany(targetEntity="Word", mappedBy="language")
     */
    protected $words;

    public function __construct()
    {
        $this->words = new ArrayCollection;
    }

    public function __toString()
    {
        return $this->name;
    }

    public function addWord($word)
    {
        $this->words[] = $word;
    
        return $this;
    }
    
    public function getWords()
    {
        return $this->words;
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
    
    public function getId()
    {
        return $this->id;
    }
}
