<?php
/* @var $this AtributController */
/* @var $model Atribut */

$this->breadcrumbs=array(
	'Atributs'=>array('index'),
	$model->at_id=>array('view','id'=>$model->at_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Atribut', 'url'=>array('index')),
	array('label'=>'Create Atribut', 'url'=>array('create')),
	array('label'=>'View Atribut', 'url'=>array('view', 'id'=>$model->at_id)),
	array('label'=>'Manage Atribut', 'url'=>array('admin')),
);
?>

<h1>Update Atribut <?php echo $model->at_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>