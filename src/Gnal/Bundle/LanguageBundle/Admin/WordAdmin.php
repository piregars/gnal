<?php

namespace Gnal\Bundle\LanguageBundle\Admin;

use Msi\AdminBundle\Admin\Admin;

class WordAdmin extends Admin
{
    public function configureDataTable($builder)
    {
        $builder
            ->add('name')
            ->add('', 'action')
        ;
    }

    public function configureForm($builder)
    {
        $builder
            ->add('name')
            ->add('lemma', 'entity', array('required' => false, 'class' => 'GnalLanguageBundle:Lemma'))
            ->add('tense', 'choice', array('choices' => array(
                'past' => 'past',
                'present' => 'present',
                'future' => 'future',
            )))
        ;
    }
}
