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
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Db\Adapter\Adapter;

class ViewController extends BaseController
{
    use ListingsTableTrait;



    public function indexAction()
    {
        //$category = $this->params()->fromQuery("category");
        $category = $this->params()->fromRoute("category");

        $listings =  $this->listingsTable->getListingsByCategory($category);

        //add css via controller
        /*$sm = $this->getEvent()->getApplication()->getServiceManager();
        $helper = $sm->get('viewhelpermanager')->get('headLink');
        $helper->prependStylesheet('/css/mystylesheet.css');*/

        return new ViewModel(array('category'=>$category, 'list'=>$listings));
    }

    public function itemAction()
    {
        //$itemId = $this->params()->fromQuery('itemId');
        $itemId = $this->params()->fromRoute('itemId');

        $item =  $this->listingsTable->getListingsById($itemId);

        if(!$itemId)
        {
            $this->flashMessenger()->addMessage("Item not found");
            return $this->redirect()->toRoute('market');
        }

        return new ViewModel(array('itemId'=>$itemId,'item'=>$item));
    }
}

