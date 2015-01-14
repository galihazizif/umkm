<?php
/* @var $this UmkmController */
/* @var $model Umkm */

$this->breadcrumbs=array(
	'Umkms'=>array('index'),
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
	$('#umkm-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h4>Daftar UMKM yang telah terdaftar.</h4>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<small>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'umkm-grid',
	'dataProvider'=>$model->search(),
	'itemsCssClass'=>'table table-bordered table-condensed table-hover sidemenu',
	'htmlOptions'=>'',
	// 'filter'=>$model,
	'columns'=>array(
		'umkm_nama',
		'umkm_email',
		array(
			'name'=>'umkm_status',
			'type'=>'raw',
			'header'=>'Status',
			'value'=>'$data->getStatusLabel()'),
		array(
			'name'=>'umkm_tanggal',
			'type'=>'raw',
			'header'=>'Terdaftar',
			'value'=>'date_format(date_create($data->umkm_tanggal),"d M Y")'),
		/*
		'umkm_lokasi_kode',
		'umkm_noreg',
		'umkm_pemilik',
		'umkm_pemilik_idcard',
		'umkm_imgurl',
		'umkm_tanggal',
		'umkm_status',
		'umkm_alias',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
</small>