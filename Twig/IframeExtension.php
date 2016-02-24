<?php

namespace Naoned\EdnaoClientBundle\Twig;

use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use Naoned\EdnaoClient\Renderer;

class IframeExtension extends \Twig_Extension
{
    use ContainerAwareTrait;

    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('ednaoIframe', array($this, 'iframe'))
        );
    }

    public function iframe()
    {
        $request = $this->container->get('request');
        // Extract roles in an array
        $roles = array_map(function ($role) {
            return $role->getRole();
        }, $this->container->get('security.context')->getToken()->getRoles());
        // format roles as ednao want them
        $rolesAsKeys = array_map(function () {
            return null;
        }, array_flip($roles));

        return Renderer::iframe(
            $this->container->getParameter('naoned_ednao_client.url'),
            $this->container->getParameter('naoned_ednao_client.socle'),
            $this->container->getParameter('naoned_ednao_client.version'),
            $this->container->getParameter('naoned_ednao_client.product'),
            $rolesAsKeys,
            str_replace("/", "", $request->getPathInfo())
        );
    }

    public function getName()
    {
        return 'ednao_iframe';
    }
}
