<?php
/* @var $this KategoriprodukController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Kategoriproduks',
);

$this->menu=array(
	array('label'=>'Create Kategoriproduk', 'url'=>array('create')),
	array('label'=>'Manage Kategoriproduk', 'url'=>array('admin')),
);
?>

<h1>Kategoriproduks</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
