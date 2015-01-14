<?php
/* @var $this PengunjungController */
/* @var $model Pengunjung */

$this->breadcrumbs=array(
	'Pengunjungs'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Pengunjung', 'url'=>array('index')),
	array('label'=>'Manage Pengunjung', 'url'=>array('admin')),
);
?>

<h1>Create Pengunjung</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>