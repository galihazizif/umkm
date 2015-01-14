<?php
/* @var $this ProdukController */
/* @var $data Produk */
?>
	
<div class="span6 media x-media" title="<?php echo CHtml::encode($data->prodUmkm->umkm_nama); ?>">
		<img class="img-polaroid media-object pull-left" style="max-width: 100px" src="<?php print ($data->prod_img != null)? Yii::app()->baseUrl.'/data/'.$data->prod_img : Yii::app()->baseUrl.'/public/empty.png' ?>">
		<h5><?php echo CHtml::encode($data->prod_nama); ?></h5>
		<p><?php echo substr(CHtml::encode($data->prod_deskripsi),0,75); ?>
		<a class="" href="<?php print $this->createUrl('u/detail',array('a'=>$data->prodUmkm->umkm_alias,'detail'=>$data->prod_id));?>">Lihat Selengkapnya</a>
	</p>
	<p><small class="label">Harga: <?php print $data->prod_harga; print ($data->prod_satuan != '')? ' / '.$data->prod_satuan : ''; ?></small></p>
</div>