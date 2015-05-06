<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Logger\Factory;


use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Logger\Service\LogggerService;

class LoggerFactory  implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $sm)
    {

        $config = '';//$sm->get('Config')['Caprio\Logger'];
        echo "<pre>";
        echo var_dump($config);
        exit;
        $logger = new LoggerService();
       // $log = new LogService();
       // $log->execute();

        return ;// $log;
    }
}
