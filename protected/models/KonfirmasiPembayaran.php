<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class KonfirmasiPembayaran extends CFormModel
{
	public $kodetransaksi;
	public $rekeningtujuan;
	public $nominal;
	public $rekeningasal;
	public $tanggal;
	public $pemilikrekening;


	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			// username and password are required
			array('kodetransaksi, rekeningtujuan,nominal,rekeningasal,pemilikrekening,tanggal', 'required'),
			// rememberMe needs to be a boolean
			array('nominal','numerical'),
			array('tanggal','date','format'=>'dd/mm/yyyy'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'kodetransaksi'=>'Kode Transaksi',
			'rekeningtujuan'=>'Rekening Tujuan',
			'nominal'=>'Nominal Rupiah',
			'rekeningasal'=>'Rekening Asal',
			'pemilikrekening'=>'Nama Pemilik Rekening',
		);
	}

}
