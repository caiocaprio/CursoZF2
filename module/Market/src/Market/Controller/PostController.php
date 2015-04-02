<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Market\Controller;


use Base\Controller\BaseController;
use Zend\View\Model\ViewModel;

class PostController extends BaseController
{
   // use ListingsTableTrait;
    public $category;

    public function setCategory($category)
    {
        $this->category = $category;
    }

    public function indexAction()
    {
        $viewModel = new ViewModel(array('category'=> $this->category));
        $viewModel->setTemplate('market/post/invalid.phtml');
        return $viewModel;
        //return new ViewModel(array('category'=> $this->category));
    }
}

