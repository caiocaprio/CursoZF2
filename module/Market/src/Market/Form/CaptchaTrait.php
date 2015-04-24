<?php
namespace Market\Form;

trait CaptchaTrait
{
    protected $captchaOptions;	
	/**
	 * @return the $captchaOptions
	 */
	public function getCaptchaOptions() {
        //echo "CaptchaTrait::getCaptchaOptions <br/>";
		return $this->captchaOptions;
	}

	/**
	 * @param field_type $captchaOptions
	 */
	public function setCaptchaOptions($captchaOptions) {
       // echo "CaptchaTrait::setCaptchaOptions <br/>";
		$this->captchaOptions = $captchaOptions;
	}
	
}