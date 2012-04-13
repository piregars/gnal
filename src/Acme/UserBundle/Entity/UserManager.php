<?php

namespace Acme\UserBundle\Entity;

use Msi\AdminBundle\Entity\ModelManager;

class UserManager extends ModelManager
{
    public function save($object)
    {
        $object->setEnabled(true);
        $this->em->persist($object);
        $this->em->flush();
    }
}
