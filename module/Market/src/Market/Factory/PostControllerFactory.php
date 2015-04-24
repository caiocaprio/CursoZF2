<?php

namespace Market\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class PostControllerFactory implements FactoryInterface
{

    public function createService(ServiceLocatorInterface $controllerManager)
    {
        $allServices = $controllerManager->getServiceLocator();
        $sm = $allServices->get('ServiceManager');

        $postController = new \Market\Controller\PostController();
        $postController->setCategories($sm->get('categories'));
        $postController->setPostForm($sm->get('market-post-form'));
        $postController->setListingsTable($sm->get('listings-table'));

        return $postController;
    }
}

