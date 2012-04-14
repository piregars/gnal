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
     * @ORM\OneToMany(targetEntity="Word", mappedBy="lemma")
     */
    protected $lexeme;

    /**
     * @ORM\OneToMany(targetEntity="Behavior", mappedBy="lemma")
     */
    protected $behaviors;

    public function __construct()
    {
        $this->behaviors = new ArrayCollection;
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
