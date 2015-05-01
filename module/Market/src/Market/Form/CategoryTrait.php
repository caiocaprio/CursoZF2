<?php
namespace Market\Form;

trait CategoryTrait
{
	protected $categories;
	/**
	 * @return the $categories
	 */
	public function getCategories() {
       // echo "CategoryTrait::getCategories <br/>";
		return $this->categories;
	}
	
	/**
	 * @param field_type $categories
	 */
	public function setCategories($categories) {
       // echo "CategoryTrait::setCategories <br/>";
		$this->categories = $categories;
	}
	
}