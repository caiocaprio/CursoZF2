<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Logger;

use Zend\Mvc\MvcEvent;
use Logger\Event\RequestEvent;
use Logger\Event\ExceptionEvent;


class Module
{

    public function onBootstrap(MvcEvent $e)
    {
        $application        = $e->getApplication();
        $eventManager       = $application->getEventManager();
        $serviceManager     = $application->getServiceManager();

        $caprioLoggerService = $serviceManager->get('Caprio\Logger');
        $eventManager->attach(new ExceptionEvent($caprioLoggerService));
        $eventManager->attach(new RequestEvent($caprioLoggerService));

        return;
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

   /* public function getServiceConfig()
    {

        return array(
            'factories' => array(
                'Caprio\Logger' => 'Logger\Factory\LoggerFactory'
            )
        );
    }*/

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
