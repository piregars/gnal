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
        //     $network->train($trainingSets[mt_rand(0, 7)]);
        // }

        // $em->persist($network);
        // $em->flush();
        $network->run(array(mt_rand(0,1), mt_rand(0,1), mt_rand(0,1)));
        $input = $network->getInput();
        echo 'Age: '.$network->getAge().' epochs.<br>';
        echo 'Input: ';
        echo $input[0].' '.$input[1].' '.$input[2];
        echo '<br>';
        echo 'Output: '.$network->getOutput();

        /***********************************************************************************/

        return new Response();
    }
}
