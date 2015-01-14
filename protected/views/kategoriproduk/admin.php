<?php
/* @var $this KategoriprodukController */
/* @var $model Kategoriproduk */

$this->breadcrumbs=array(
	'Kategoriproduks'=>array('index'),
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
	$('#kategoriproduk-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h4>Kategori Produk</h4>

<p>
Produk yang dimasukkan oleh UMKM dikategorikan menurut kelompok kegunaannya. Kategori produk tidak dapat dihapus jika sudah ada minimal 1 produk yang dimasukkan kedalam kategori terkait.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'kategoriproduk-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'itemsCssClass'=>'table table-bordered table-condensed table-hover table-striped',
	'filterPosition'=>'footer',
	'htmlOptions'=>'',
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
	'columns'=>array(
		'kat_id',
		'kat_nama',
		array(
			'name'=>'kat_status',
			'value'=>'$data->getStatusLabel()'),
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
