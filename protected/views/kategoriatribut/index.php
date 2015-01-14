<?php
/* @var $this KategoriatributController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Kategoriatributs',
);

$this->menu=array(
	array('label'=>'Create Kategoriatribut', 'url'=>array('create')),
	array('label'=>'Manage Kategoriatribut', 'url'=>array('admin')),
);
?>

<h1>Kategoriatributs</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
