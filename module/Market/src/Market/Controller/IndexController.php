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
    use ListingsTableTrait;
<<<<<<< HEAD
=======


>>>>>>> M10EX1

    public function indexAction()
    {

        $messages = array();
        if($this->flashMessenger()->hasMessages())
        {
            $messages = $this->flashMessenger()->getMessages();
        }

        $itemRecent = $this->listingsTable->getLastestListing();

       // return new ViewModel(array('messages'=>$messages));
        return array('messages'=>$messages, 'item'=>$itemRecent);
        //return new ViewModel();
    }

    public function fooAction()
    {
        return new ViewModel();
    }
} 