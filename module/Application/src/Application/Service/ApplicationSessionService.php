<?php
/**
 * Created by PhpStorm.
 * User: Caio
 * Date: 28/04/2015
 * Time: 17:14
 */

namespace Application\Service;


use Zend\Session\Container;

class ApplicationSessionService {

    private $container;

    function  __construct()
    {
        $this->container = new Container('sessions');

        if(!isset($this->container->limitInvalidPost)){
            $this->container->limitInvalidPost = 10;
        }

        if(!isset($this->container->countPost)){
            $this->container->countPost = 0;
        }
    }

    public function incrementCount()
    {
        $this->container->countPost++;
        return $this;
    }

    public function resetCount()
    {
        $this->container->countPost = 0;
    }

    public function isLimit()
    {
        if($this->container->countPost >= $this->container->limitInvalidPost)
        {
            return true;
        }else
        {
            return false;
        }
    }

    public function getCount()
    {
        return $this->container->countPost;
    }
} 