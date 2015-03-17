<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Base;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

class Module
{

    public function onBootstrap(MvcEvent $e)
    {
        //$this->setLayoutBetoAp($e);
        $this->setLayoutCaprio($e);
    }

    private  function setLayoutCaprio(MvcEvent $e)
    {
        /*$app = $e->getApplication();
        $acl = $app->getServiceManager()->get('ACL'); // get your ACL here

        if (!$acl->isAllowed()) {
            $em = $app->getEventManager();
            $em->attach(MvcEvent::EVENT_DISPATCH, function($e) {
                $routeMatch = $e->getRouteMatch();

                $routeMatch->setParam('controller', 'my-403-controller');
                $routeMatch->setParam('action', 'my-403-action');
            }, 1000);
        }*/


        $app = $e->getApplication();
        $em = $app->getEventManager();
        $sm = $em->getSharedManager();
        $acl = $app->getServiceManager()->get('ACL'); // get your ACL here

        if (!$acl->isAllowed()) {
            $em->attach(MvcEvent::EVENT_DISPATCH, function($e) {

                $routeMatch = $e->getRouteMatch();
                var_dump($routeMatch);
                exit;
                //$routeMatch->setParam('controller', 'my-403-controller');
                //$routeMatch->setParam('action', 'my-403-action');
            }, 1000);
        }



        $sm->attach('Zend\Mvc\Controller\AbstractController', MvcEvent::EVENT_DISPATCH, function($e)
        {

            $config = $e->getApplication()->getServiceManager()->get('config');
            $routeMatch = $e->getRouteMatch();
            $controllerName = strtolower($routeMatch->getParam('controller'));
            $actionName = strtolower($routeMatch->getParam('action'));
            $routerName = $routeMatch->getMatchedRouteName();

            $controller = $e->getTarget();

            echo "<pre>";
            var_dump($controllerName);
            var_dump($actionName);
            var_dump($routeMatch->getMatchedRouteName());
            exit;

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
            }else{
                echo nl2br("Não Existe ".$config['layouts']['default']);
                $controller->layout($config['layouts']['default']);
            }

        }, 10);
    }

    private function setLayoutBetoAp(MvcEvent $e){

        $e->getApplication()->getEventManager()->getSharedManager()->attach('Zend\Mvc\Controller\AbstractActionController', 'dispatch', function($e) {
            echo "ae";
            exit;
            $controller      = $e->getTarget();
            $controllerClass = get_class($controller);
            $moduleNamespace = substr($controllerClass, 0, strpos($controllerClass, '\\'));
            $config          = $e->getApplication()->getServiceManager()->get('config');
            $routeMatch      = $e->getRouteMatch();
            $actionName      = strtolower($routeMatch->getParam('action', 'not-found'));
            if (isset($config['module_layouts'][$moduleNamespace][$actionName])) {
                $controller->layout($config['module_layouts'][$moduleNamespace][$actionName]);
            }elseif(isset($config['module_layouts'][$moduleNamespace]['default'])) {
                $controller->layout($config['module_layouts'][$moduleNamespace]['default']);
            }
        }, 100);
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
