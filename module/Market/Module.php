<?php
/**
 * Created by PhpStorm.
 * User: caio.caprio
 * Date: 25/02/2015
 * Time: 16:27
 *
 */

namespace Market;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;


class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $app = $e->getApplication();
        $em = $app->getEventManager();
        $sm = $em->getSharedManager();


        /*$em->attach(MvcEvent::EVENT_DISPATCH, array($this, 'onDispatchEM'), 1000);
        $em->attach(MvcEvent::EVENT_DISPATCH_ERROR, array($this, 'onDispatchErrorEM'), 100);

        $sm->attach('Zend\Mvc\Controller\AbstractController', MvcEvent::EVENT_DISPATCH,  array($this, 'onDispatchSM'));
        $sm->attach('Zend\Mvc\Controller\AbstractController', MvcEvent::EVENT_DISPATCH_ERROR,  array($this, 'onDispatchErrorSM'));*/
    }

    public function onDispatchSM(MvcEvent $e)
    {
        echo "Market::onDispatcSM<br/>";
        // echo "<pre>";
        //var_dump($e->getApplication()->getEventManager()->getSharedManager());

        //$this->setLayoutDefault($e);
    }

    public function onDispatchEM(MvcEvent $e)
    {
        echo "Market::onDispatcEM<br/>";



        //$this->setLayoutDefault($e);
    }

    public function onDispatchErrorSM(MvcEvent $e)
    {
        echo "Market::onDispatcErrorSM<br/>";

    }

    public function onDispatchErrorEM(MvcEvent $e)
    {
        echo "Market::onDispatcErrorEM<br/>";

        //$this->setLayoutError($e);
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
        echo "ERROR MARKET<br/>";
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
            'Zend\Loader\ClassMapAutoloader' =>array(
                __DIR__.'/autoload_classmap.php',
            ),

            ///Com esse código abaixo comentado, é necessario gerar o autoload_classmap.php
            ///exemplo: diretorio-do-modulo php D:\Caio\CursoZendFramework2\desenvolvimento\CursoZF2\vendor\zendframework\zendframework\bin\classmap_generator.php
            /*'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),*/
        );
    }
} 