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
        $app = $e->getApplication();
        $em = $app->getEventManager();
        $sm = $em->getSharedManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($em);

       /* $em->attach(MvcEvent::EVENT_DISPATCH, array($this, 'onDispatchEM'), 10);
        $em->attach(MvcEvent::EVENT_DISPATCH_ERROR, array($this, 'onDispatchErrorEM'), 100);

        $sm->attach('Zend\Mvc\Controller\AbstractController', MvcEvent::EVENT_DISPATCH,  array($this, 'onDispatchSM'));
        $sm->attach('Zend\Mvc\Controller\AbstractController', MvcEvent::EVENT_DISPATCH_ERROR,  array($this, 'onDispatchErrorSM'));*/

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

    public function onDispatchSM(MvcEvent $e)
    {
        echo "Application::onDispatcSM<br/>";
        // echo "<pre>";
        //var_dump($e->getApplication()->getEventManager()->getSharedManager());

        //$this->setLayoutDefault($e);
    }

    public function onDispatchEM(MvcEvent $e)
    {
        echo "Application::onDispatcEM<br/>";

        $sm = $e->getApplication()->getServiceManager();
        $categories = $sm->get("categories");
        $vm = $e->getViewModel();
        $vm->setVariable("categories",$categories);

        //$this->setLayoutDefault($e);
    }

    public function onDispatchErrorSM(MvcEvent $e)
    {
        echo "Application::onDispatcErrorSM<br/>";
    }

    public function onDispatchErrorEM(MvcEvent $e)
    {
        echo "Application::onDispatcErrorEM<br/>";

    }

    public function setLayoutDefault(MvcEvent $e)
    {
        // echo "<pre>";
        //echo "CAIU<br/>";
        $routeMatch = $e->getRouteMatch();
        // var_dump($routeMatch);
        //var_dump($e->getTarget());
        // exit;

        $config = $e->getApplication()->getServiceManager()->get('config');
        $routeMatch = $e->getRouteMatch();
        $controllerName = strtolower($routeMatch->getParam('controller'));
        $actionName = strtolower($routeMatch->getParam('action'));
        //$routerName = $routeMatch->getMatchedRouteName();

        $controller = $e->getTarget();



        // Use o layout atribuído à ação
        if(isset($config['layouts']['controllers'][$controllerName]['actions'][$actionName]))
        {
            //echo nl2br("possui layout em action ".$config['layouts']['controllers'][$controllerName]['actions'][$actionName]);
            $controller->layout($config['layouts']['controllers'][$controllerName]['actions'][$actionName]);
        }
        // Use o layout padrão controlador
        elseif(isset($config['layouts']['controllers'][$controllerName]['default']))
        {
            // echo nl2br("Use o layout padrão do controller ".$config['layouts']['controllers'][$controllerName]['default']);
            $controller->layout($config['layouts']['controllers'][$controllerName]['default']);
        }
        // Use o módulo layout padrão
        elseif(isset($config['layouts']['default']))
        {
            //echo nl2br("Use o layout padrão do módulo ".$config['layouts']['default']);
            $controller->layout($config['layouts']['default']);
        }else{
            //echo nl2br("Não Existe ".$config['layouts']['default']);
            $controller->layout($config['layouts']['default']);
        }
    }

    public  function onDispatchErro(MvcEvent $e)
    {
        $serviceManager = $e->getApplication()->getServiceManager();
        $layout = $serviceManager->get( 'viewManager' )->getViewModel();

        $config = $e->getApplication()->getServiceManager()->get('config');
        //$routeMatch = $e->getRouter();
        // $controllerName = strtolower($routeMatch->getParam('controller'));
        //$actionName = strtolower($routeMatch->getParam('action'));

        //$controller = $e->getTarget();


        //$layout->setTemplate($config['layouts']['default']);

        echo "<pre>";
        echo "ERROR APPLICATION<br/>";
        //$controller = explode("/", $e->getRequest()->getRequestUri())[1];
        //$routeMatch = $e->getRouteMatch();
        //$e->getRequest(),
        var_dump($e->getRequest());
        //var_dump($e->getTarget());
        exit;

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
