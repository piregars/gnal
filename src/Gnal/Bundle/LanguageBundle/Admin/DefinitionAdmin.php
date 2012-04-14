<?php

namespace Gnal\Bundle\LanguageBundle\Admin;

use Msi\AdminBundle\Admin\Admin;

class DefinitionAdmin extends Admin
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
        ;
    }
}
