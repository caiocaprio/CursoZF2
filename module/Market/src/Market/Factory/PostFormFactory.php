<?php
namespace Market\Factory;
use Market\Form\PostForm;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
class PostFormFactory implements FactoryInterface
{
	public function createService(ServiceLocatorInterface $sm)
	{
        echo "PostFormFactory::createService <br/>";

		/*
		* Isto é um exemplo de como realizar a configurações do formulário,
		* O importante é registrar o campos do formulário pedidos no exercícios
		*/

        $form = new PostForm();
		$form->setCategories($sm->get('market-categories'));
		$form->setExpireDays($sm->get('market-expire-days'));
		$form->setCaptchaOptions($sm->get('market-captcha-options'));
		$form->setInputFilter($sm->get('market-post-filter'));
		$form->buildForm();
		return $form;
	}
}