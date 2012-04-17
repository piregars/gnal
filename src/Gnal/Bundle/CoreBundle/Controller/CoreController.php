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
        $network = $em->getRepository('GnalAnnBundle:Network')->findOneBy(array('id' => 1));

        // $trainingSets[0] = array('input' => array(1,1,1), 'expectedOutput' => 0);
        // $trainingSets[1] = array('input' => array(1,1,0), 'expectedOutput' => 0);
        // $trainingSets[2] = array('input' => array(1,0,0), 'expectedOutput' => 1);
        // $trainingSets[3] = array('input' => array(0,1,1), 'expectedOutput' => 0);
        // $trainingSets[4] = array('input' => array(0,0,1), 'expectedOutput' => 1);
        // $trainingSets[5] = array('input' => array(1,0,1), 'expectedOutput' => 0);
        // $trainingSets[6] = array('input' => array(0,1,0), 'expectedOutput' => 1);
        // $trainingSets[7] = array('input' => array(0,0,0), 'expectedOutput' => 0);

        // for ($i=0; $i < 1000; $i++) {
        //     $network->train($trainingSets[rand(0, 7)]);
        // }

        // $em->persist($network);
        // $em->flush();

        /***********************************************************************************/

        die($network->run(array(1, 1, 0)));

        return array();
    }
}
