<?php

namespace Gnal\Bundle\AnnBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Gnal\Bundle\AnnBundle\Entity\Network;
use Gnal\Bundle\AnnBundle\Entity\Layer;
use Gnal\Bundle\AnnBundle\Entity\Neuron;
use Gnal\Bundle\AnnBundle\Entity\Synapse;

class LoadAnnData extends AbstractFixture
{
    protected $manager;

    public function load(ObjectManager $manager)
    {
        $this->manager = $manager;

        $network = new Network();
        $network->setName('XOR');

        $layer = new Layer();

        $
    }

    protected function loadEquipmentType()
    {
        $e = new EquipmentType();
        $e->setName('Test Calibration');
        $this->type = $e;
        $this->save($e);
    }

    protected function save($e)
    {
        $this->manager->persist($e);
        $this->manager->flush();
    }
}
