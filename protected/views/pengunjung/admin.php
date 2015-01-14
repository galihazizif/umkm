<?php
/* @var $this PengunjungController */
/* @var $model Pengunjung */

$this->breadcrumbs=array(
	'Pengunjungs'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'<i class="icon-th-large"></i> Kelola', 'url'=>array('admin')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#pengunjung-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h4>Data Pengunjung yang terdaftar</h4>

<small>
<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'pengunjung-grid',
	'dataProvider'=>$model->search(),
	// 'filter'=>$model,
	'itemsCssClass'=>'table table-bordered table-condensed table-hover sidemenu',
	'htmlOptions'=>'',
	'columns'=>array(
		'pgj_email',
		'pgj_nama',
		'pgj_nohp',
		array(
			'name'=>'pgj_lastlogin',
			'type'=>'text',
			'value'=>'date_format(date_create($data->pgj_lastlogin),"d M Y / H:i:s")'),
		/*
		'pgj_alamat',
		'pgj_lastlogin',
		'pgj_ref',
		'pgj_status',
		*/
		array(
			'class'=>'CButtonColumn',
			'updateButtonImageUrl'=>false,
			'updateButtonLabel'=>'',
		),
	),
)); ?>
</small>