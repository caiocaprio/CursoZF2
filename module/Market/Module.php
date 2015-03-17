<?php
/**
 * Created by PhpStorm.
 * User: caio.caprio
 * Date: 25/02/2015
 * Time: 16:27
 */

namespace Market;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;


class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager = $e->getApplication()->getEventManager();

        /*$sem = $eventManager->getSharedManager();
        $sem->attach( 'Zend\Mvc\Controller\AbstractController', 'dispatch', function($e)
        {

             $config = $e->getApplication()->getServiceManager()->get('config');

             $routeMatch = $e->getRouteMatch();
             $c = explode('\\', $routeMatch->getParam('controller'));
             $controllerName = array_shift($c);
             $actionName = strtolower($routeMatch->getParam('action'));
             $controller = $e->getTarget();

            // Use o layout atribuído à ação
            if(isset($config['layouts']['controllers'][$controllerName]['actions'][$actionName]))
            {
                echo nl2br("possui layout em action ".$config['layouts']['controllers'][$controllerName]['actions'][$actionName]);
                $controller->layout($config['layouts']['controllers'][$controllerName]['actions'][$actionName]);
            }
            // Use o layout padrão controlador
            elseif(isset($config['layouts']['controllers'][$controllerName]['default']))
            {
                echo nl2br("Use o layout padrão do controller ".$config['layouts']['controllers'][$controllerName]['default']);
                $controller->layout($config['layouts']['controllers'][$controllerName]['default']);
            }
            // Use o módulo layout padrão
            elseif(isset($config['layouts']['default']))
            {
                echo nl2br("Use o layout padrão do módulo ".$config['layouts']['default']);
                $controller->layout($config['layouts']['default']);
            }

        }, 10);*/
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoLoader' =>array(
                __DIR__.'/autoload_classmap.php',
            ),

            /*'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),*/
        );
    }
} 