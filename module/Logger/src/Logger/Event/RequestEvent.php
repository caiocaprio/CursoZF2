<?php
namespace Logger\Event;

use Zend\EventManager\ListenerAggregateInterface;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\EventInterface;
use Zend\Mvc\MvcEvent;
use Zend\Log\Logger as Log;

use Zend\Stdlib\CallbackHandler;

class RequestEvent implements ListenerAggregateInterface
{


    protected $log;

    public function getLog()
    {
        return $this->log;
    }
    public function setLog(Log $log)
    {
        $this->log = $log;

        return $this;
    }


    /********************************************************************************/

    public function __construct(Log $log = null)
    {
        if (!is_null($log)) {
            $this->setLog($log);
        }
    }

    protected $listeners = array();

    public function getListeners()
    {
        return $this->listeners;
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
        $this->addListener($events->attach(MvcEvent::EVENT_ROUTE, array($this, 'onRouteEvent')));
    }

    public function detach(EventManagerInterface $events)
    {
        foreach ($this->getListeners() as $index => $listener) {
            if ($events->detach($listener)) {
                $this->removeListener($index);
            }
        }
    }

    public function onRouteEvent(EventInterface $event)
    {
        if ($event->getRequest() instanceOf \Zend\Http\PhpEnvironment\Request) {
            $this->getLog()->debug(
                print_r(
                    array(
                        $event->getRequest()->getUri()->getHost() => array(
                            'Request' => $event->getRequest()->getUri()
                        )
                    )
                    ,
                    true
                )
            );
        }
    }

    /********************************************************************************/
}
