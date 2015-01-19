<?php

/**
 * ContactForm class.
 * ContactForm is the data structure for keeping
 * contact form data. It is used by the 'contact' action of 'SiteController'.
 */
class RegisterUmkmForm extends CFormModel
{
	public $umkm_nama;
	public $umkm_deskripsi;
	public $umkm_email;
	public $cemail;
	public $umkm_password;
	public $cpassword;
	public $verifyCode;
	public $provinsi;
	public $kabupaten;
	public $kecamatan;
	public $desa;
	public $umkm_alias;
	public $agreement;

	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
			// name, email, subject and body are required
			array('umkm_nama, umkm_deskripsi, umkm_email, umkm_password, cemail, cpassword, provinsi, kabupaten, kecamatan, desa', 'required'),
			// email has to be a valid email address
			array('umkm_alias', 'length','max'=> 15),
			array('umkm_email', 'email'),
			array('umkm_password', 'length','min'=> 6,'max'=> 20),
			array('umkm_password', 'compare','compareAttribute'=>'cpassword'),
			array('umkm_email', 'compare','compareAttribute'=>'cemail'),
			// verifyCode needs to be entered correctly
			array('verifyCode', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements()),
		);
	}

	/**
	 * Declares customized attribute labels.
	 * If not declared here, an attribute would have a label that is
	 * the same as its name with the first letter in upper case.
	 */
	public function attributeLabels()
	{
		return array(
			'verifyCode'=>'Verification Code',
			'cpassword'=>'Konfirmasi Password',
			'cemail'=>'Konfirmasi Email',
			'umkm_email'=>'Email',
			'umkm_nama'=>'Nama UMKM',
			'umkm_password' => 'Password',
			'umkm_deskripsi'=>'Deskripsi singkat UMKM Anda',
			'umkm_alias'=>'Alias UMKM anda, misal: <i class="label">majumakmur</i>',
		);
	}
}