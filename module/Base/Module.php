<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Base;

use Zend\Http\Request;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

class Module
{

    public function onBootstrap(MvcEvent $e)
    {
        $app = $e->getApplication();
        $em = $app->getEventManager();
        $sm = $em->getSharedManager();

        $em->attach(MvcEvent::EVENT_DISPATCH, array($this, 'onDispatch'));
        $em->attach(MvcEvent::EVENT_DISPATCH_ERROR, array($this, 'onDispatchError'));

        $sm->attach('Zend\Mvc\Controller\AbstractController', MvcEvent::EVENT_DISPATCH,  array($this, 'onDispatchShared'), 100);
    }

    public function onDispatchShared(MvcEvent $e)
    {
        $this->setLayoutDefault($e);
    }

    public function onDispatch(MvcEvent $e)
    {
        $sm = $e->getApplication()->getServiceManager();


        $categories = $sm->get("market-categories");
        $vm = $e->getViewModel();

        $vm->setVariable("categories",$categories);

        $route = $e->getRouteMatch();
        $routeName = $e->getRouteMatch()->getMatchedRouteName();
        $vm->setVariable("routeMatch",$route);
        $vm->setVariable("routeName",$routeName);
    }


    public function onDispatchError(MvcEvent $e)
    {
        /*
     *  $serviceManager = $e->getApplication()->getServiceManager();
        $layout = $serviceManager->get( 'viewManager' )->getViewModel();
 */
        $sm = $e->getApplication()->getServiceManager();
        $categories = $sm->get("market-categories");
        $vm = $e->getViewModel();
        $vm->setVariable("categories",$categories);

        $moduleName = ($e->getRouteMatch() ? explode('-',explode('/',$e->getRouteMatch()->getMatchedRouteName())[0])[0] : 'application');
        $config = $e->getApplication()->getServiceManager()->get('config');

        $templateError =  $config['module_layouts'][ucfirst($moduleName)]['error-index'];
        if($e->getResponse()->getStatusCode() == 404)
        {
            $templateError =  $config['module_layouts'][ucfirst($moduleName)]['error-index'];
        }

        $vm->setTemplate($config['module_layouts'][ucfirst($moduleName)]['layout']);


    }


    public function setLayoutDefault(MvcEvent $e)
    {
        $controller      = $e->getTarget();
        $controllerClass = get_class($controller);
        $moduleNamespace = substr($controllerClass, 0, strpos($controllerClass, '\\'));
        $config          = $e->getApplication()->getServiceManager()->get('config');

        if (isset($config['module_layouts'][$moduleNamespace])) {
            $controller->layout($config['module_layouts'][$moduleNamespace]['layout']);
        }else{
            $controller->layout($config['module_layouts']['Default']['layout']);
        }
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

    /*public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'Logger' => function ($sm) {
                    $filename = 'log_' . date('Y-m-d') . '.txt';
                    $log = new Logger();
                    $writer = new Stream('./data/logs/' . $filename);
                    $log->addWriter($writer);
                    return $log;
                },
            ),
        );
    }*/
}
