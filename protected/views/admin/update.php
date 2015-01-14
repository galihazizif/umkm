<?php
/* @var $this AdminController */
/* @var $model Admin */

$this->breadcrumbs=array(
	'Admins'=>array('index'),
	$model->admin_id=>array('view','id'=>$model->admin_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Admin', 'url'=>array('index')),
	array('label'=>'Create Admin', 'url'=>array('create')),
	array('label'=>'View Admin', 'url'=>array('view', 'id'=>$model->admin_id)),
	array('label'=>'Manage Admin', 'url'=>array('admin')),
);
?>

<h4>Sunting <?php echo $model->admin_email; ?> <span class="label"></span></h4>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>