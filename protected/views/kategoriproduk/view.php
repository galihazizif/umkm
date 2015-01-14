<?php
/* @var $this KategoriprodukController */
/* @var $model Kategoriproduk */

$this->breadcrumbs=array(
	'Kategoriproduks'=>array('index'),
	$model->kat_id,
);

$this->menu=array(
	array('label'=>'<i class="icon-plus"></i> Tambah', 'url'=>array('create')),
	array('label'=>'<i class="icon-edit"></i> Sunting', 'url'=>array('update', 'id'=>$model->kat_id)),
	array('label'=>'<i class="icon-remove"></i> Hapus', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->kat_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'<i class="icon-th-large"></i> Kelola', 'url'=>array('admin')),
);
?>

<h4>Rincian Kategori Produk</h4>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'htmlOptions'=>array('class'=>'table table-condensed table-bordered table-striped table-hover'),
	'attributes'=>array(
		'kat_id',
		'kat_nama',
		array(
			'name'=>'kat_status',
			'value'=>$model->getStatusLabel()),
	),
)); ?>
