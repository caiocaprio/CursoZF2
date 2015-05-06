<?php

namespace Logger\Event;

use Logger\Service\LoggerService;
use Zend\EventManager\ListenerAggregateInterface;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\EventInterface;
use Zend\Mvc\MvcEvent;
use Zend\Stdlib\CallbackHandler;
use Exception;

class ExceptionEvent  implements  ListenerAggregateInterface
{
    protected $log;
    public function getLog()
    {
        return $this->log;
    }
    public function setLog($log)
    {
        $this->log = $log;
    }




    /********************************************************************************/

    protected $listeners = array();

    public function __construct(LoggerService $loggerService = null)
    {
        if (!is_null($loggerService)) {
            $this->setLog($loggerService);
        }
    }

    public function addListener(CallbackHandler $listeners)
    {
        $this->listeners[] = $listeners;
        return $this;
    }

    public function removeListener($index)
    {
        if (!empty($this->listeners[$index])) {
            unset($this->listeners[$index]);
            return true;
        }
        return false;
    }

    public function attach(EventManagerInterface $events)
    {
        //$this->listeners[] = $events->attach('eventName', array($this, 'doEvent'));
        $this->addListener($events->attach(MvcEvent::EVENT_DISPATCH_ERROR, array($this, 'onDispatchError')));
    }

    public function detach(EventManagerInterface $events)
    {
        foreach ($this->listeners as $index => $listener) {
            if ($events->detach($listener)) {
                unset($this->listeners[$index]);
            }
        }
    }

    public function onDispatchError(EventInterface $event)
    {

        $exception = $event->getResult()->exception;


        if (isset($exception) && $exception instanceof Exception ) {
            $previous = $exception->getPrevious();

            $this->getLog()->debug(
                print_r(
                    array(
                        $event->getRequest()->getUri()->getHost() => array(
                            'Request' => $event->getRequest()->getUri(),
                            'Exception'=> array(
                                'Class'=> get_class($exception),
                                'Code'=> $exception->getCode(),
                                'Message'=> $exception->getMessage(),
                                'File'=> $exception->getFile().":".$exception->getLine(),
                                'Trace'=> $exception->getTraceAsString(),
                                'Previous'=> array(
                                    'Class'=> get_class($previous),
                                    'Code'=> $previous->getCode(),
                                    'Message'=> $previous->getMessage(),
                                    'File'=> $previous->getFile().":".$previous->getLine(),
                                    'Trace'=> $exception->getTraceAsString(),
                                ),
                            )
                        ),
                    ),
                    true
                )
            );
        }

        //echo "ExceptionEvent::onDispatchError </br>";
       // var_dump($exception);
       // exit;
    }

    /********************************************************************************/
} 