<?php
/* @var $this AtributController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Atributs',
);

$this->menu=array(
	array('label'=>'Create Atribut', 'url'=>array('create')),
	array('label'=>'Manage Atribut', 'url'=>array('admin')),
);
?>

<h1>Atributs</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
