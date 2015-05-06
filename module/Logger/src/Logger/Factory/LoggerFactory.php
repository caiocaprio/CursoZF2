<?php

namespace Logger\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Log\Filter\Priority;
use Zend\Log\Logger as ZendLogger;
use Logger\Service\LoggerService;

class LoggerFactory  implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $sm)
    {
        $logger = new LoggerService();

        $config = $sm->get('Config')['Caprio\Logger'];
        $writers = 0;
        foreach ($config['writers'] as $writer)
        {
            if ($writer['enabled'])
            {
                $writerAdapter = new $writer['adapter'](
                    (isset($writer['options']['output']) ? $writer['options']['output'] : "\\data\\").
                    (isset($writer['options']['filename']) ? $writer['options']['filename'] : "log").'_'.
                    date((isset($writer['options']['dateFormat']) ? $writer['options']['dateFormat'] : "Y-m-d")).
                    (isset($writer['options']['extension']) ? $writer['options']['extension'] : ".log")
                );

                $logger->addWriter($writerAdapter);
                $writerAdapter->addFilter(
                    new Priority(
                        $writer['filter']
                    )
                );
                $writers++;
            }
        }

        !$config['registerErrorHandler'] ? : ZendLogger::registerErrorHandler($logger);
        !$config['registerExceptionHandler'] ? : ZendLogger::registerExceptionHandler($logger);

        $writers > 0 ? : $logger->addWriter(new \Zend\Log\Writer\Null);

        return $logger;
    }
}
