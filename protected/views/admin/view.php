<?php
/* @var $this AdminController */
/* @var $model Admin */

$this->breadcrumbs=array(
	'Admins'=>array('index'),
	$model->admin_id,
);

$this->menu=array(
	array('label'=>'<i class="icon-plus"></i> Tambah', 'url'=>array('create')),
	array('label'=>'<i class="icon-edit"></i> Sunting', 'url'=>array('update', 'id'=>$model->admin_id)),
	array('label'=>'<i class="icon-remove"></i> Hapus', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->admin_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'<i class="icon-th-large"></i> Kelola', 'url'=>array('admin')),
);
?>


<h4>Rincian <?php echo $model->admin_email.' <span class="label">'.$model->adminUmkm->umkm_nama.'</span>'; ?></h4>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'htmlOptions'=>array('class'=>'table table-condensed'),
	'attributes'=>array(
		'admin_email',
		array(
			'name'=>'admin_regdate',
			'value'=>date_format(date_create($model->admin_regdate),'d M Y')),
		array(
			'name'=>'admin_lastlogin',
			'value'=>date_format(date_create($model->admin_lastlogin),'d M Y / H:i:s')),
		array(
			'name'=>'adminUmkm.umkm_nama',
			'value'=>$model->adminUmkm->umkm_nama),
		array(
			'name'=>'admin_isowner',
			'value'=>$model->ownership()),
		array(
			'name'=>'admin_status',
			'value'=>$model->getStatusLabel()),
	),
)); ?>
