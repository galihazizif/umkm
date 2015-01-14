<?php
/* @var $this ProdukController */
/* @var $data Produk */
?>

<a class="span2 btn thumb-item" href="<?php print $this->createUrl('u/detail',array('a'=>$data->prodUmkm->umkm_alias,'detail'=>$data->prod_id));?>" title="<?php echo CHtml::encode($data->prodUmkm->umkm_nama); ?>">
	<span class="label"><?php echo CHtml::encode($data->prodKat->kat_nama); ?></span>
	<div class="" >
		<img class="img-polaroid" style="" src="<?php print ($data->prod_img != null)? Yii::app()->baseUrl.'/data/'.$data->prod_img : Yii::app()->baseUrl.'/public/empty.png' ?>">
		<h5><?php echo CHtml::encode($data->prod_nama); ?></h5>
		<p><?php echo substr(CHtml::encode($data->prod_deskripsi),0,75).'...'; ?></p>
	</div>
</a>