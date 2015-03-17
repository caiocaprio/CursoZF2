<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
        $eventManager->attach(MvcEvent::EVENT_DISPATCH, array($this, 'onDispatch'), 100);

       /* $sem = $eventManager->getSharedManager();
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

    /*
     * public function getServiceConfig()
    {
        return array(
            'invokables'=>array(
                'ExemploService' => 'Application\Service\ExemploService',
                'DbService' => 'Application\Service\DbService',
            )
        );
    }*/

    public function onDispatch(MvcEvent $e)
    {
        $sm = $e->getApplication()->getServiceManager();
        $categories = $sm->get("categories");
        $vm = $e->getViewModel();

        $vm->setVariable("categories",$categories);




    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
}
