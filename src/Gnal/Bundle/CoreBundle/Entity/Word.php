<?php

namespace Gnal\Bundle\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="core_word")
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
     * @ORM\Column(unique="true")
     */
    protected $name;

    /**
     * @ORM\Column(type="text", nullable="true")
     */
    protected $definition;
    
    // Noun
    // Verb
    // Participle
    // Interjection
    // Pronoun
    // Preposition
    // Adverb
    // Conjunction
    protected $category;

    protected $language;
}
