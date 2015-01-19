<?php
/* @var $this AtributController */
/* @var $model Atribut */

$this->breadcrumbs=array(
	'Atributs'=>array('index'),
	$model->at_id,
);

$this->menu=array(
	array('label'=>'List Atribut', 'url'=>array('index')),
	array('label'=>'Create Atribut', 'url'=>array('create')),
	array('label'=>'Update Atribut', 'url'=>array('update', 'id'=>$model->at_id)),
	array('label'=>'Delete Atribut', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->at_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Atribut', 'url'=>array('admin')),
);
?>

<h1>View Atribut #<?php echo $model->at_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'at_id',
		'at_kategori_id',
		'at_umkm_id',
		'at_text',
	),
)); ?>
