<?php
/* @var $this KategoriatributController */
/* @var $model Kategoriatribut */

$this->breadcrumbs=array(
	'Kategoriatributs'=>array('index'),
	$model->ka_id=>array('view','id'=>$model->ka_id),
	'Update',
);

$this->menu=array(
	array('label'=>'<i class="icon-plus"></i> Tambah', 'url'=>array('create')),
	array('label'=>'<i class="icon-th-large"></i> Kelola', 'url'=>array('admin')),
);
?>

<h4>Update Kategoriatribut <span class="label"><?php echo $model->ka_id.' | '.$model->ka_nama; ?></span></h4>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>