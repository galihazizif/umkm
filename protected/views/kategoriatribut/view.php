<?php
/* @var $this KategoriatributController */
/* @var $model Kategoriatribut */

$this->breadcrumbs=array(
	'Kategoriatributs'=>array('index'),
	$model->ka_id,
);

$this->menu=array(
	array('label'=>'<i class="icon-plus"></i> Tambah', 'url'=>array('create')),
	array('label'=>'<i class="icon-edit"></i> Sunting', 'url'=>array('update', 'id'=>$model->ka_id)),
	array('label'=>'<i class="icon-remove"></i> Hapus', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ka_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'<i class="icon-th-large"></i> Kelola', 'url'=>array('admin')),
);
?>

<h4>Rincian Kategori Atribut</h4>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'htmlOptions'=>array('class'=>'table table-condensed table-striped table-bordered table-hover'),
	'attributes'=>array(
		'ka_id',
		'ka_nama',
	),
)); ?>
