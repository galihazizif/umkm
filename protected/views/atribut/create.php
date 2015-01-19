<?php
/* @var $this AtributController */
/* @var $model Atribut */

$this->breadcrumbs=array(
	'Atributs'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Atribut', 'url'=>array('index')),
	array('label'=>'Manage Atribut', 'url'=>array('admin')),
);
?>

<h1>Create Atribut</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>