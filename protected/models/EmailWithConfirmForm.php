<?php

/**
 * ContactForm class.
 * ContactForm is the data structure for keeping
 * contact form data. It is used by the 'contact' action of 'SiteController'.
 */
class EmailWithConfirmForm extends CFormModel
{
	public $email;
	public $conf_email;
	public $password;
	public $conf_password;

	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
			// name, email, subject and body are required
			array('email,password,conf_password', 'required'),
			// email has to be a valid email address
			array('email, conf_email', 'email'),
			array('email','compare','compareAttribute'=>'conf_email'),
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