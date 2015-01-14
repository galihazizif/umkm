<?php
/* @var $this PagesController */
/* @var $model Pages */

$this->breadcrumbs=array(
	'Pages'=>array('index'),
	$model->p_id=>array('view','id'=>$model->p_id),
	'Update',
);

$this->menu=array(
	array('label'=>'<i class="icon-plus"></i> Tambah', 'url'=>array('create')),
	array('label'=>'<i class="icon-th-large"></i> Kelola', 'url'=>array('admin')),
);?>

<h4>Sunting halaman <?php echo $model->p_judul.' ['.$model->p_id.']'; ?></h4>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>