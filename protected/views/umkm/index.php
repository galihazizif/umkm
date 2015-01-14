<?php
/* @var $this UmkmController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Umkms',
);

$this->menu=array(
	array('label'=>'Create Umkm', 'url'=>array('create')),
	array('label'=>'Manage Umkm', 'url'=>array('admin')),
);
?>

<h1>Umkms</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
