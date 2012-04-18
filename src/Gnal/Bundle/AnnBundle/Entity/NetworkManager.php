<?php

namespace Gnal\Bundle\AnnBundle\Entity;

use Doctrine\ORM\EntityManager;

class NetworkManager
{
    protected $em;
    protected $repository;
    protected $class;
    
    public function __construct(EntityManager $em, $class)
    {
        $this->em = $em;
        $this->repository = $em->getRepository($class);
        $this->class = $em->getClassMetadata($class)->name;
    }
   
    public function findOneBy(array $criteria)
    {
        return $this->repository->findOneBy($criteria);
    }

    public function findAll()
    {
        return $this->repository->findBy(array());
    }

    public function save($object)
    {
        $this->em->persist($object);
        $this->em->flush();
    }
    
    public function delete($object)
    {
        $this->em->remove($object);
        $this->em->flush();
    }

    public function create($params)
    {
        return new $this->class($params);
    }
    
    public function getClass()
    {
        return $this->class;
    }
}
