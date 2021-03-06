<?php
namespace Market\Form;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Input;
use Zend\Validator\Regex;
use Market\Form\Filter\Float;

class PostFilter extends InputFilter
{

	use CategoryTrait;
	use ExpireDaysTrait;


	
	public function buildFilter()
	{
        //echo "PostFilter::buildFilter <br/>";

		/******************************************************************
		* Isto é um exemplo de como realizar a configurações do filtro,
		* O importante é registrar o campos do formulário pedidos no exercícios
		**********************************************************************/
		
		// filter & validate by fields
		$category = new Input('category');
		$category->getFilterChain()
				 ->attachByName('StringTrim')
				 ->attachByName('StripTags')
				 ->attachByName('StringToLower');
		$category->getValidatorChain()
				 ->attachByName('InArray', array('haystack' => $this->getCategories()));

		$title = new Input('title');
		$title->getFilterChain()
					->attachByName('StringTrim')
					->attachByName('StripTags');
		$titleRegex = new Regex(array('pattern' => '/^[a-zA-Z0-9 ]*$/'));
		$titleRegex->setMessage('O Título deve conter letras, números e espaço.');
		$title->getValidatorChain()
			  ->attach($titleRegex)
			  ->attachByName('StringLength', array('min' => 1, 'max' => 128));

		$photo = new Input('photo_filename');
		$photo->getFilterChain()
				 ->attachByName('StripTags')
				 ->attachByName('StringTrim');
		$photo->getValidatorChain()
			  ->attachByName('Regex', array('pattern' => '!^(http://)?[a-z0-9./_-]+(jp(e)?g|png)$!i'));
		$photo->setErrorMessage('Photo must be a URL or a valid filename ending with jpg or png');

		$price = new Input('price');
		$price->setAllowEmpty(TRUE);
		$price->getValidatorChain()
			  ->addByName('GreaterThan', array('min' => 0.00));
		$price->getFilterChain()
			  ->attach(new Float());	// custom filter
      //  var_dump(array_keys($this->getExpireDays()));
       // exit;
		$expires = new Input('expires');
		$expires->setAllowEmpty(TRUE);
		$expires->getValidatorChain()
				->attachByName('InArray', array('haystack' => array_keys($this->getExpireDays()),true));
		$expires->getFilterChain()
			    ->attachByName('StripTags')
				->attachByName('StringTrim');

		$city = new Input('city');
		$city->setAllowEmpty(TRUE);
		$city->getFilterChain()
			 ->attachByName('StripTags')
			 ->attachByName('StringTrim');

		$name = new Input('contact_name');
		$name->setAllowEmpty(TRUE);
		$name->getValidatorChain()
			  ->attachByName('Regex', array('pattern' => '/^[a-z0-9., -]{1,255}$/i'));
		$name->setErrorMessage('Name should only contain letters, numbers, and some punctuation.');
		$name->getFilterChain()
			  ->attachByName('StripTags')
			  ->attachByName('StringTrim');

		$phone = new Input('contact_phone');
		$phone->setAllowEmpty(TRUE);
		$phone->getValidatorChain()
			  ->attachByName('Regex', array('pattern' => '/^\+?\d{1,4}(-\d{3,5})+$/'));
		$phone->setErrorMessage('Phone number must be in this format: +9999-999-999-9999');
		$phone->getFilterChain()
			  ->attachByName('StripTags')
			  ->attachByName('StringTrim');

		$email = new Input('contact_email');
		$email->setAllowEmpty(TRUE);
		$email->getValidatorChain()
			  ->attachByName('EmailAddress');
		$email->getFilterChain()
			  ->attachByName('StripTags')
			  ->attachByName('StringTrim');

		$description = new Input('description');
		$description->setAllowEmpty(TRUE);
		$description->getValidatorChain()
					->attachByName('StringLength', array('min' => 1, 'max' => 4096));
		$description->getFilterChain()
				    ->attachByName('StripTags')
				    ->attachByName('StringTrim');

		$delCode = new Input('delete_code');
		$delCode->setRequired(TRUE);
		$delCode->getValidatorChain()
			    ->addByName('Digits');

		$this->add($category)
			 ->add($title)
			 ->add($photo)
			 ->add($price)
			 ->add($expires)
			 ->add($city)
			 ->add($name)
			 ->add($phone)
			 ->add($email)
			 ->add($description)
		     ->add($delCode)
        ;
	}
}
