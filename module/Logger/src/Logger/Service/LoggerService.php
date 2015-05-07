<?php

namespace Logger\Service;

use Zend\Log\Logger as ZendLogger;

class LoggerService extends ZendLogger
{

    final public function log($priority, $message, $extra = array())
    {
        $customExtra = array(
            'Caprio\Logger' => array(
                'sessionId' => session_id(),
                'host'      => !empty($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : 'CLI',
                'ip'        => !empty($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : 'unavailable'
            )
        );

        return parent::log($priority, $message, array_merge($extra, $customExtra));
    }




} 