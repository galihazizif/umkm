<?php
/* @var $this PagesController */
/* @var $model Pages */

$this->breadcrumbs=array(
	'Pages'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'<i class="icon-th-large"></i> Kelola', 'url'=>array('admin')),
);?>

<h4>Tambahkan Halaman</h4>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>