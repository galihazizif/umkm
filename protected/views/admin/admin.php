<?php
/* @var $this AdminController */
/* @var $model Admin */

$this->breadcrumbs=array(
	'Admins'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'<i class="icon-plus"></i> Tambah', 'url'=>array('create')),
	array('label'=>'<i class="icon-th-large"></i> Kelola', 'url'=>array('admin')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#admin-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h4>Akun pengelola UMKM</h4>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<small>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'admin-grid',
	'dataProvider'=>$model->search(),
	'itemsCssClass'=>'table table-bordered table-condensed table-hover table-striped',
	'htmlOptions'=>'',
	//'filter'=>$model,
	'columns'=>array(
		'admin_id',
		'admin_email:text:Email',
		array(
			'name'=>'admin_regdate',
			'type'=>'raw',
			'value'=>'date_format(date_create($data->admin_regdate),"d M Y")',
			'header'=>'Registrasi'),
		array(
			'name'=>'admin_lastlogin',
			'type'=>'raw',
			'value'=>'date_format(date_create($data->admin_lastlogin),"d M Y / H:i:s")',
			'header'=>'Login Terakhir'),
		array(
			'name'=>'adminUmkm.umkm_nama',
			'type'=>'text',
			'value'=>'$data->adminUmkm->umkm_nama'),
		/*
		'admin_isowner',
		'admin_status',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
</small>