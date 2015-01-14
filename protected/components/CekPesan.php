<?php 
class CekPesan extends CWidget{
	
	function cekPesan(){
		$tipe = Yii::app()->user->getTipe();
		$uid = Yii::app()->user->_getId();
		return Pesan::model()->count('pes_tujuantipe = :tipe AND pes_tujuanid =:id AND pes_status = :status',
			array(
				':tipe'=>$tipe,
				':id'=>$uid,
				':status'=>'0')
			);
		
	}

}

?>