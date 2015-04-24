<?php
namespace Market\Form;

trait ExpireDaysTrait
{
    
	protected $expireDays;
	
	/**
	 * @return the $expireDays
	 */
	public function getExpireDays() {
       // echo "ExpireDaysTrait::getExpireDays <br/>";
		return $this->expireDays;
	}
	
	/**
	 * @param array $expireDays;
	 */
	public function setExpireDays($expireDays) {
        //echo "ExpireDaysTrait::setExpireDays <br/>";
		$this->expireDays = $expireDays;
	}
	
}