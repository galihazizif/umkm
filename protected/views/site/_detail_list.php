<?php
/* @var $this ProdukController */
/* @var $data Produk */
?>

<div class="media span7 produklist">
	<a class="pull-left" href="<?php print $this->createUrl('u/detail',array('a'=>$data->prodUmkm->umkm_alias,'detail'=>$data->prod_id));?>" title="<?php echo CHtml::encode($data->prodUmkm->umkm_nama); ?>">
		<img class="img-polaroid media-object" style="width:100px" src="<?php print ($data->prod_img != null)? Yii::app()->baseUrl.'/data/'.$data->prod_img : Yii::app()->baseUrl.'/public/empty.png' ?>">
	</a>
	<div class="media-body">
		<div class="media-heading">
			<h5><?php echo CHtml::encode($data->prod_nama); ?>
				<span class="label"><?php echo CHtml::encode($data->prodKat->kat_nama); ?></span>
			</h5>
		</div>
		<p>
			<p><?php echo substr(CHtml::encode($data->prod_deskripsi),0,75).'...'; ?>
				<a href="<?php print $this->createUrl('u/detail',array('a'=>$data->prodUmkm->umkm_alias,'detail'=>$data->prod_id));?>" title="<?php echo CHtml::encode($data->prodUmkm->umkm_nama); ?>">Lihat Selengkapnya</a>
			</p>
		</p>
	</div>
</div>
