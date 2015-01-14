<?php
/* @var $this KategoriatributController */
/* @var $model Kategoriatribut */

$this->breadcrumbs=array(
	'Kategoriatributs'=>array('index'),
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
	$('#kategoriatribut-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h4>Kategori Atribut</h4>

<p>
Kategori ini digunakan untuk menamai berbagai macam atribut untuk setiap akun UMKM seperti Jenis Nomor Rekening, jenis kontak dsb.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'kategoriatribut-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'itemsCssClass'=>'table table-bordered table-condensed table-hover table-striped',
	'filterPosition'=>'footer',
	'pagerCssClass'=>'pagination',
	'pager'=>array(
				'class'=>'CLinkPager',
				'header'=>' ',
				'firstPageCssClass'=>'',
				'nextPageLabel'=>'>',
				'prevPageLabel'=>'<',
				'firstPageLabel'=>'<<',
				'lastPageLabel'=>'>>',
				'hiddenPageCssClass'=>'disabled',
				'selectedPageCssClass'=>'active',
				'htmlOptions'=>array('class'=>''),
				),
	// 'htmlOptions'=>'',
	'columns'=>array(
		'ka_id:text:Kategori ID',
		'ka_nama:text:Nama',
		array(
			'class'=>'CButtonColumn',
			'header'=>'...',
		),
	),
)); ?>
