<?php
/* @var $this UController */


$this->pageTitle = $umkm->umkm_nama.' - '.$model->prod_nama ;

/*This is required for applying custom user interface for every umkm user*/

?>
<div class="row">&nbsp;</div>
<?php $this->renderPartial('/u/_uSearchInput',array('umkm'=>$umkm));?>
<div class="row">
<?php $this->renderPartial('/u/sidebar',array('umkm'=>$umkm));?>
<div class="span7 offset1 well">
	<div class="media">
		<a class="pull-left" href="#">
			<img class="media-object img-polaroid" style="max-width: 200px" src="<?php print ($model->prod_img != null)? Yii::app()->baseUrl.'/data/'.$model->prod_img : Yii::app()->baseUrl.'/public/empty.png' ?>">
		</a>
		<div class="media-body">
			<h4 class="media-heading"><?php print $model->prod_nama; ?></h4>
			<?php if($model->items->item_stok < 1): ?>
			<small class="label label-important">Stok Habis</small>
		</h4>
	<?php endif;?>
	<div class="media">
		<p><?php print $model->prod_deskripsi; ?></p>
		<p class="label">Harga: <?php print 'Rp. '.number_format($model->prod_harga,2,',','.'); print ($model->prod_satuan != '')? ' / '.$model->prod_satuan : ''; ?></p>
		<p class="label">Stok: <?php print $model->items->item_stok; ?></p>
		<?php if($model->items->item_stok > 0 && $model->prodUmkm->umkm_status == Umkm::STATUS_VERIFIED): ?>
		<p>
			<?php print CHtml::ajaxLink('Beli',
				array('produk/addtocart','id'=>$model->prod_id),
				array(
					'beforeSend'=>'function(){loadingIcon(\'#myModal\');$("#myModal").modal();}',
					'success'=>'js:function(data){$("#myModal").html(data);}'),
					array('class' =>'btn btn-primary'));?>
				</p>
			<?php endif; ?>
			<?php if($model->items->item_stok < 1): ?>
			<p><a class="btn btn-danger disabled" href="#"><i class="icon-remove icon-white"></i> Beli</a></p>
			<?php endif;?>
			<?php if($model->prodUmkm->umkm_status == Umkm::STATUS_REGISTERED): ?>
			<p class="alert alert-danger"><?php print $model->prodUmkm->umkm_nama;?> belum terverifikasi, anda tidak dapat melakukan pembelian online. Silahkan hubungi kontak <?php print $model->prodUmkm->umkm_nama;?></p>
			<?php endif;?>

	</div>
</div>
</div>
</div>
</div>