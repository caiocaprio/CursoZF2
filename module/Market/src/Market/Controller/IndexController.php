<?php
/**
 * Created by PhpStorm.
 * User: caio.caprio
 * Date: 25/02/2015
 * Time: 16:37
 */

namespace Market\Controller;


use Base\Controller\BaseController;
use Zend\View\Model\ViewModel;

class IndexController extends BaseController
{
    //use ListingsTableTrait;

    public function indexAction()
    {

        $messages = array();
        if($this->flashMessenger()->hasMessages())
        {
            $messages = $this->flashMessenger()->getMessages();
        }

       // return new ViewModel(array('messages'=>$messages));
        return array('messages'=>$messages);
        //return new ViewModel();
    }

    public function fooAction()
    {
        return new ViewModel();
    }
} 