<?php

namespace Gnal\Bundle\LanguageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Table(name="language_lemma")
 * @ORM\Entity
 */
class Lemma
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
     * @ORM\Column(type="text", nullable="true")
     */
    protected $denotation;

    /**
     * @ORM\ManyToMany(targetEntity="Connotation", inversedBy="lemmas")
     * @ORM\JoinTable(name="lemmas_connotations")
     */
    protected $connotations;

    /**
     * @ORM\OneToMany(targetEntity="Lexeme", mappedBy="lemma")
     */
    protected $lexemes;

    /**
     * @ORM\ManyToOne(targetEntity="LexicalCategory", inversedBy="lemmas")
     * @ORM\JoinColumn(name="lexical_category_id")
     */
    protected $lexicalCategory;

    public function __construct()
    {
        $this->lexemes = new ArrayCollection;
        $this->connotations = new ArrayCollection;
    }

    public function __toString()
    {
        return $this->name;
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
