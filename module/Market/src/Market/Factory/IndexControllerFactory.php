<?php

namespace Market\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class IndexControllerFactory implements FactoryInterface
{

    public function createService(ServiceLocatorInterface $controllerManager)
    {
        //echo "IndexControllerFactory::createService <br/>";

        $allServices = $controllerManager->getServiceLocator();
        $sm = $allServices->get('ServiceManager');

<<<<<<< HEAD

        $indexController = new \Market\Controller\IndexController();
=======
        //$categories = $sm->get('categories');

        $indexController = new \Market\Controller\IndexController();
       // $indexController->setCategory($categories);
        //$indexController->setPostForm($sm->get('market-post-form'));
>>>>>>> M10EX1
        $indexController->setListingsTable($sm->get('listings-table'));
        return $indexController;
    }
}

