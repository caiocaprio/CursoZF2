<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        //$exemploService = $this->getServiceLocator()->get("ExemploService");
        //print_r($exemploService); die;
        return new ViewModel();
    }

    public function exemploAction()
    {
        $nome = "Zend Framework 2";

        return new ViewModel(array('xpto'=>nome));
    }
}
