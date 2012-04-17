<?php

namespace Gnal\Bundle\CoreBundle\Controller;

use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Gnal\Bundle\AnnBundle\Entity\Network;

class CoreController extends ContainerAware
{
    /**
     * @Route("/")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->container->get('doctrine')->getEntityManager();

        // $network = new Network(array(2, 3, 1));
        // $network->setName('Perceptron');
        
        // $em->persist($network);
        // $em->flush();

        $network = $em->getRepository('GnalAnnBundle:Network')->findOneBy(array('id' => 1));

        $network->train(array(0, 1), 0);

        $em->persist($network);
        $em->flush();

        die($network->getName());
        return array();
    }
}
