<?php

/**
 * ContactForm class.
 * ContactForm is the data structure for keeping
 * contact form data. It is used by the 'contact' action of 'SiteController'.
 */
class PasswordForm extends CFormModel
{
	public $password;
	public $conf_password;

	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
			// name, email, subject and body are required
			array('password,conf_password', 'required'),
			array('password','length','min'=>6,'max'=>20),
			// email has to be a valid email address
			array('password','compare','compareAttribute'=>'conf_password'),
			// verifyCode needs to be entered correctly
		);
	}

	/**
	 * Declares customized attribute labels.
	 * If not declared here, an attribute would have a label that is
	 * the same as its name with the first letter in upper case.
	 */
	
}