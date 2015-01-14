<?php
/* @var $this ProdukController */
/* @var $model Produk */

$this->breadcrumbs=array(
	'Produks'=>array('index'),
	$model->prod_id,
);

$this->menu=array(
	array('label'=>'<i class="icon-plus"></i> Tambah', 'url'=>array('create')),
	array('label'=>'<i class="icon-edit"></i> Sunting', 'url'=>array('update', 'id'=>$model->prod_id)),
	array('label'=>'<i class="icon-remove"></i> Hapus', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->prod_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'<i class="icon-th-large"></i> Kelola', 'url'=>array('admin')),
);
?>

<h4><?php echo $model->prod_nama; ?></h4>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'htmlOptions'=>array('class'=>'table'),
	'attributes'=>array(
		'prod_nama:text:Nama Produk',
		'prod_deskripsi',
		'prodKat.kat_nama:text:Kategori',
		'prod_harga:number:Harga',
	),
)); ?>

<div class="span2">
	<?php if($model->prod_img != null): ?>
	<img class="img-polaroid" src="<?php print Yii::app()->baseUrl.'/data/'.$model->prod_img; ?>">
	<?php endif;?>
</div>
