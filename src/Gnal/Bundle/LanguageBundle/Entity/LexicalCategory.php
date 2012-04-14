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
     * @ORM\ManyToOne(targetEntity="Behavior", inversedBy="lexicalCategory")
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
}
