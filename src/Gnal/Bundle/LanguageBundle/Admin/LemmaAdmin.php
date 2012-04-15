<?php

namespace Gnal\Bundle\LanguageBundle\Admin;

use Msi\AdminBundle\Admin\Admin;

class LemmaAdmin extends Admin
{
    public function configureDataTable($builder)
    {
        $builder
            ->add('name')
            ->add('lexicalCategory')
            ->add('', 'action')
        ;
    }

    public function configureForm($builder)
    {
        $builder
            ->add('name')
            ->add('lexicalCategory', 'entity', array('class' => 'GnalLanguageBundle:LexicalCategory'))
            ->add('connotations', 'entity', array(
                'class' => 'GnalLanguageBundle:Connotation',
                'required' => false,
                'multiple' => true
            ))
        ;
    }
}
