<?php

namespace Acme\UserBundle\Admin;

use Msi\AdminBundle\Admin\Admin;
use Doctrine\ORM\EntityRepository;

class UserAdmin extends Admin
{
    public function configureDataTable($builder)
    {
        $builder
            ->add('username', 'text', array('edit' => true))
            ->add('', 'action')
        ;
    }

    public function configureForm($builder)
    {
        $builder
            ->add('username')
            ->add('email', 'email')
            ->add('roles', 'choice', array(
                'choices' => array('ROLE_ADMIN' => 'ADMIN', 'ROLE_CLIENT' => 'CLIENT'), 
                'expanded' => false,
                'multiple' => true,
                'required' => false, 
            ))
            ->add('plainPassword', 'repeated', array(
                'type' => 'password',
                'invalid_message' => 'The password fields must match.',
                'first_name' => 'Password',
                'second_name' => 'Confirm password',
                'required' => $this->getAction() === 'edit' ? false : true, 
            ))
        ;
    }
}
