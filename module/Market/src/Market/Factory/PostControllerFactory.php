<?php

namespace Market\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class PostControllerFactory implements FactoryInterface
{

    public function createService(ServiceLocatorInterface $controllerManager)
    {
        //echo "PostControllerFactory::createService <br/>";

        $allServices = $controllerManager->getServiceLocator();
        $sm = $allServices->get('ServiceManager');

        $postController = new \Market\Controller\PostController();
        $postController->setListingsTable($sm->get('listings-table'));
        $postController->setPostForm($sm->get('market-post-form'));

        return $postController;
    }
}

