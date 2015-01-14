<?php
/* @var $this PengunjungController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Pengunjungs',
);

$this->menu=array(
	array('label'=>'Create Pengunjung', 'url'=>array('create')),
	array('label'=>'Manage Pengunjung', 'url'=>array('admin')),
);
?>

<h1>Pengunjungs</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
