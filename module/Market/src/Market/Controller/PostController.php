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
use Market\Form\CategoryTrait;
use Zend\View\Model\ViewModel;

class PostController extends BaseController
{
    use ListingsTableTrait;
    use CategoryTrait;


    private $postForm;

    public function setPostForm($postForm)
    {
        // "PostController::setPostForm <br/>";
        $this->postForm = $postForm;
    }

    public function invalidCount()
    {
        $sessionService = $this->getServiceLocator()->get('application-session');
        if($sessionService->incrementCount()->isLimit())
        {
            $sessionService->resetCount();
            return true;
        }
        return false;
    }

    public function indexAction()
    {


       // echo "PostController::indexAction <br/>";
        $data = $this->params()->fromPost();



        $viewModel = new ViewModel(array('postForm'=> $this->postForm, 'data' => $data));
        $viewModel->setTemplate('market/post/index.phtml');

        if($this->getRequest()->isPost())
        {
            $this->postForm->setData($data);
            if($this->postForm->isValid())
            {
                $this->listingsTable->addPosting($this->postForm->getData());
                $this->flashMessenger()->addMessage('Sucesso no Post!');
                $this->redirect()->toRoute('market');
            }else{

                if(!$this->invalidCount())
                {
                    $invalidView = new ViewModel();
                    $invalidView->setTemplate('market/post/invalid.phtml');
                    $invalidView->addChild($viewModel, 'main');
                    return $invalidView;
                }else{
                    $invalidView = new ViewModel();
                    $invalidView->setTemplate('market/post/limite-tentativas.phtml');
                    $invalidView->addChild($viewModel, 'main');
                    return $invalidView;
                }
            }
        }



       /* $viewModel = new ViewModel(array('category'=> $this->category));
        $viewModel->setTemplate('market/post/invalid.phtml');*/
        return $viewModel;
    }
}

