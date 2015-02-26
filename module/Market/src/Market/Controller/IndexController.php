<?php
/**
 * Created by PhpStorm.
 * User: caio.caprio
 * Date: 25/02/2015
 * Time: 16:37
 */

namespace Market\Controller;


use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
      return new ViewModel();
    }
} 