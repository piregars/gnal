<?php

namespace Gnal\Bundle\CoreBundle\Controller;

use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class CoreController extends ContainerAware
{
    /**
     * @Route("/")
     * @Template()
     */
    public function indexAction()
    {
        return array();
    }
}
