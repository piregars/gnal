<?php

namespace Gnal\Bundle\LanguageBundle\Admin;

use Msi\AdminBundle\Admin\Admin;

class BehaviorAdmin extends Admin
{
    public function configureDataTable($builder)
    {
        $builder
            ->add('', 'action')
        ;
    }

    public function configureForm($builder)
    {
        $builder
            ->add('lexicalCategory', 'entity', array('required' => false, 'class' => 'GnalLanguageBundle:LexicalCategory'))
        ;
    }
}
