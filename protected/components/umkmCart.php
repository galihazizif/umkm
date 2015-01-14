<?php
class umkmCart extends CComponent{

	private $cookieId;

	public function __construct(){
		if(isset($_COOKIE['umkm_cart'])){
			$this->cookieId = $_COOKIE['umkm_cart'];
		}
		else{
			$this->cookieId = self::generateCookieId();
			setcookie('umkm_cart',$this->cookieId,time() + 3600 * 24,'/');
			//cookie berakhir 24 jam kemudian
		}
	}

	public function cekBelanjaan(){
			return Keranjang::model()->count('krj_session = :cookie AND krj_status = :status',array(
				':cookie'=>$this->cookieId,
				':status'=>Keranjang::STATUS_ADD));
	}

	public function getCartCookie(){
		self::__construct();
		return $this->cookieId;
	}

	private function generateCookieId(){
		return sha1(date('YmdHis').microtime());
	}

	public function showButton(){
		print CHtml::ajaxLink('<i class="icon-shopping-cart"></i> Keranjang <span class="badge badge-important">'.$this->cekBelanjaan().'</span>',
			array('produk/precheckout'),
			array(
				'beforeSend'=>'function(){loadingIcon("#myModal");$("#myModal").modal();}',
				'success'=>'function(data){$("#myModal").html(data)}',
				),
			array('class'=>'btn btn-small'));
	}
}

?>