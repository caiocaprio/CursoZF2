<?php
namespace Market\Factory;
use Market\Form\PostForm;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
class PostFormFactory implements FactoryInterface
{
	public function createService(ServiceLocatorInterface $sm)
	{
		/*
		* Isto é um exemplo de como realizar a configurações do formulário,
		* O importante é registrar o campos do formulário pedidos no exercícios
		*/

        $form = new PostForm();
		$form->setCategories($sm->get('categories'));
		//$form->setExpireDays($sm->get('market-expire-days'));
		//$form->setCaptchaOptions($sm->get('market-captcha-options'));
		$form->setInputFilter($sm->get('market-post-filter'));
		$form->buildForm();
		return $form;

        //$allServices = $sm->getServiceLocator();
        //$sm = $allServices->get('ServiceManager');

        /*
            $categories = $sm->get('categories');
            ///$postController = new \Market\Controller\PostController();
            ///$postController->setCategory($categories);
            ///$postController->setPostForm($sm->get('market-post-form'));

            $form = new PostForm();
            $form->setCategories($categories);
            $form->buildForm();
            $form->setInputFilter($sm->get('market-post-filter'));

            return $form;
         */


	}
}