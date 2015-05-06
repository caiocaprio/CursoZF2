<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Caprio\Logger\Factory;

use Caprio\Logger\Service\LogggerService;


class LoggerFactory  implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $sm)
    {

        $config = $sm->get('Log');
        echo "<pre>";
        echo var_dump("AAAAAAAAAAAAAAAAAAAAAAA");
        exit;

        $log = new LogService();
        $log->execute();

        return  $log;
    }
}
