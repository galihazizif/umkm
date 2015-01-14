<?php
/* @var $this PengunjungController */
/* @var $model Pengunjung */

$this->breadcrumbs=array(
	'Pengunjungs'=>array('index'),
	$model->pgj_id=>array('view','id'=>$model->pgj_id),
	'Update',
);

$this->menu=array(
	array('label'=>'<i class="icon-th-large"></i> Kelola', 'url'=>array('admin')),
);
?>

<h4>Perbaharui data pengunjung "<?php echo $model->pgj_email; ?>"</h4>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>