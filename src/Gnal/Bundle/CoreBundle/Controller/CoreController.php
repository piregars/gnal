<?php

namespace Gnal\Bundle\CoreBundle\Controller;

use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Gnal\Bundle\CoreBundle\Brain\Brain;

class CoreController extends ContainerAware
{
    /**
     * @Route("/")
     * @Template()
     */
    public function indexAction()
    {
        

        
        // $x = array(0,1,0,1,1,1,0,1,0);
        // $w = array(0,1,0,1,1,1,0,1,0);
        // $activation = 0;

        // for ($i=0; $i < count($x); $i++) { 
        //     $activation += $x[$i] * $w[$i];
        // }

        // var_dump($activation);

        return array();
    }
}
