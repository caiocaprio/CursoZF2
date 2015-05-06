<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Logger;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Logger\Service\LoggerService;

class Module
{

    public function onBootstrap(MvcEvent $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();

        $eventManager->attach('dispatch.error', function($event){
            $exception = $event->getResult()->exception;
            if ($exception) {
                $sm = $event->getApplication()->getServiceManager();
                $service = $sm->get('Caprio\Logger');
                $service->logException($exception);
            }
        });

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

    public function getServiceConfig()
    {

        return array(
            'factories' => array(
                'Caprio\Logger' => function($sm){
                    $config = $sm->get('Config')['Caprio\Logger\Config'];
                    $logger = new LoggerService();

                    echo var_dump($logger);
                    exit;
                    return $logger;
                },
            )
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
