<?php

namespace Gnal\Bundle\LanguageBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Gnal\Bundle\LanguageBundle\Entity\Language;
use Gnal\Bundle\LanguageBundle\Entity\LexicalCategory;

class LoadLanguageData extends AbstractFixture
{
    protected $manager;

    public function load(ObjectManager $manager)
    {
        $this->manager = $manager;

        $this->loadLanguage();
        $this->loadLexicalCategory();
    }

    protected function loadLanguage()
    {
        $e = new language();
        $e->setName('English');
        $this->save($e);
        $this->lang = $e;
    }

    protected function loadWord()
    {
        $words = array(
            array(
                'name' => 'plane',
                'category' => $this->categories['noun'],
            ),
            array(
                'name' => 'edible',
                'category' => $this->categories['adjective'],
            ),
            array(
                'name' => 'boy',
                'category' => $this->categories['noun'],
            ),
            array(
                'name' => 'love',
                'category' => $this->categories['noun'],
            ),
            array(
                'name' => 'love',
                'category' => $this->categories['verb'],
            ),
            array(
                'name' => 'fungus',
                'category' => $this->categories['noun'],
            ),
            array(
                'name' => 'tree',
                'category' => $this->categories['noun'],
            ),
            array(
                'name' => 'he',
                'category' => $this->categories['pronoun'],
            ),
        );

        foreach ($words as $word) {
            $e = new Word();
            $e->setName($word['name'])->setCategory($word['category'])->setLanguage($this->lang);
            $this->save($e);
        }
    }

    protected function loadLexicalCategory()
    {
        $names = array(
            'noun',
            'verb',
            'adjective',
            'interjection',
            'pronoun',
            'preposition',
            'adverb',
            'conjunction'
        );

        foreach ($names as $name) {
            $e = new LexicalCategory();
            $e->setName($name);
            $this->save($e);

            $this->categories[$name] = $e;
        }
    }

    protected function save($e)
    {
        $this->manager->persist($e);
        $this->manager->flush();
    }
}
