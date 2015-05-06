<?php

return array(


    'Caprio\Logger\Config' => array(
        'registerErrorHandler'     => 'true', // errors logged to your writers
        'registerExceptionHandler' => 'true', // exceptions logged to your writers

        // multiple zend writer output & zend priority filters
        'writers' => array(
            'standard-error' => array(
                'adapter'  => '\Zend\Log\Writer\Stream',
                'options'  => array(
                    'output' => 'php://stderr'
                ),
                // options: EMERG, ALERT, CRIT, ERR, WARN, NOTICE, INFO, DEBUG
                'filter' => \Zend\Log\Logger::DEBUG,
                'enabled' => true
            ),
            'standard-file' => array(
                'adapter'  => '\Zend\Log\Writer\Stream',
                'options'  => array(
                    'output' => 'data/application.log', // path to file
                ),
                // options: EMERG, ALERT, CRIT, ERR, WARN, NOTICE, INFO, DEBUG
                'filter' => \Zend\Log\Logger::DEBUG,
                'enabled' => true
            ),
            'standard-db' => array(
                'adapter'  => '\Zend\Log\Writer\Stream',
                'options'  => array(
                    'output' => '', // path to file
                ),
                // options: EMERG, ALERT, CRIT, ERR, WARN, NOTICE, INFO, DEBUG
                'filter' => \Zend\Log\Logger::DEBUG,
                'enabled' => true
            ),
        )


    ),





);
