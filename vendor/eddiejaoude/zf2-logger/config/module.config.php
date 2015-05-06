<?php
return array(
    'EddieJaoude\Zf2Logger' => array(

        // will add the $logger object before the current PHP error handler
        'registerErrorHandler'     => 'true', // errors logged to your writers
        'registerExceptionHandler' => 'true', // exceptions logged to your writers

        // multiple zend writer output & zend priority filters
        'writers' => array(
            'standard-file' => array(
                'adapter'  => '\Zend\Log\Writer\Stream',
                'options'  => array(
                    'output' => 'data/application.log', // path to file
                ),
                // options: EMERG, ALERT, CRIT, ERR, WARN, NOTICE, INFO, DEBUG
                'filter' => \Zend\Log\Logger::DEBUG,
                'enabled' => true
            ),
        )
    )
);
