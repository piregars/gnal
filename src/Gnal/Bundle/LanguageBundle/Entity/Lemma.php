<?php

namespace Gnal\Bundle\LanguageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Table(name="language_lemma", uniqueConstraints={@ORM\UniqueConstraint(name="IDX_name_lexical_category_id", columns={"name", "lexical_category_id"})})
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

    /**
     * @ORM\ManyToOne(targetEntity="Language", inversedBy="lemmas")
     */
    protected $language;

    public function __construct()
    {
        $this->lexemes = new ArrayCollection;
        $this->connotations = new ArrayCollection;
    }

    public function __toString()
    {
        return $this->name;
    }

    public function addConnotation($connotation)
    {
        $this->connotations[] = $connotation;
    
        return $this;
    }
    
    public function getConnotations()
    {
        return $this->connotations;
    }

    public function getLexicalCategory()
    {
        return $this->lexicalCategory;
    }
    
    public function setLexicalCategory($lexicalCategory)
    {
        $this->lexicalCategory = $lexicalCategory;
    
        return $this;
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
