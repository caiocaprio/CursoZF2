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

        $categories = $sm->get('categories');

        $postController = new \Market\Controller\PostController();
        $postController->setCategory($categories);



        try {
            // ...
            $factoryPostForm = $sm->get('market-post-form');
            // ...
        } catch (\Exception $e) {
            do {
                var_dump($e->getMessage());
            } while ($e = $e->getPrevious());
        }


       // echo "<pre>";
       // var_dump($factoryPostForm);
        exit;
        //$postController->setPostForm($sm->get('market-post-form'));


       // $postController->setPostForm($sm->get('market-post-form'));

        return $postController;
    }
}

