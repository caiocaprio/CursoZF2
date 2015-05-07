<?php
namespace Logger;

return array(

    'Caprio\Logger' => array(
        'registerErrorHandler'     => 'true', // errors logged to your writers
        'registerExceptionHandler' => 'true', // exceptions logged to your writers

        // multiple zend writer output & zend priority filters
        'writers' => array(
            'file' => array(
                'adapter'  => '\Zend\Log\Writer\Stream',
                'options'  => array(
                    'output' => 'data/', // path to file
                    'filename' => 'log', // path to file
                    'extension' => '.log', // path to file
                    'dateFormat' => 'd-m-Y', // path to file
                ),
                // options: EMERG, ALERT, CRIT, ERR, WARN, NOTICE, INFO, DEBUG
                'filter' => \Zend\Log\Logger::DEBUG,
                'enabled' => true
            ),
            'db' => array(
                'adapter'  => '\Zend\Log\Writer\Db',
                'options'  => array(
                    'output' => 'general-adapter', // path to file
                    'tableName' => 'logs',
                    'columns' => array(
                        'timestamp' => 'date',
                        'priority'  => 'priority',
                        'message'   => 'message'
                    ),
                ),
                // options: EMERG, ALERT, CRIT, ERR, WARN, NOTICE, INFO, DEBUG
                'filter' => \Zend\Log\Logger::DEBUG,
                'enabled' => true
            ),
        )


    ),

    'service_manager' => array(
        'factories' => array(
            'Caprio\Logger' => 'Logger\Factory\LoggerFactory',
        )
    ),
);
