<?php
/* @var $this ProdukController */
/* @var $model Produk */

$this->breadcrumbs=array(
	'Produk'=>array('index'),
	'Pengelolaan',
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
	$('#produk-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h4>Pengelolaan Produk</h4>

<div>
	<div class="search-form span8" style="">
	<?php $this->renderPartial('_search',array(
		'model'=>$model,
	)); ?>
	</div><!-- search-form -->
</div>

	
<small>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'produk-grid',
	'dataProvider'=>(Yii::app()->user->isSysAdmin())? $model->search() : $model->onlyThisUmkm(Yii::app()->user->getUmkmId()),
	//'dataProvider'=>$model->search(),
	//'filter'=>$model,
	'htmlOptions'=>array('class'=>''),
	'itemsCssClass'=>'table table-bordered table-condensed table-hover sidemenu',
	'enablePagination'=>true,
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
	'pagerCssClass'=>'pagination',
	'columns'=>array(
		array(
			'name'=>'prod_nama',
			'header'=>'Nama'),
		// 'prodKat.kat_nama:text:Kategori',
		array(
			'name'=>'prodKat.kat_nama',
			'value'=>'$data->prodKat->kat_nama',
			'header'=>'Kategori',
			'htmlOptions'=>array('style'=>'width: 175px'),
			),
		array(
			'name'=>'prodUmkm.umkm_nama',
			'value'=>'$data->prodUmkm->umkm_nama',
			'header'=>'UMKM',
			'htmlOptions'=>array('style'=>'width: 175px'),
			'visible'=>Yii::app()->user->isSysAdmin(),
			),
		array(
			'name'=>'prod_harga',
			'htmlOptions'=>array('style'=>'width: 120px; text-align: right'),
			'value'=>'"Rp ".number_format($data->prod_harga,0,",",".")'),
		array(
			'name'=>'items.item_stok',
			'type'=>'raw',
			'value'=>'$data->items->item_stok." <button class=\"btn btn-mini pull-right\" u-url=\"'.'edititem/$data->prod_id\" onclick=\"oAjaxLink(this,true)\"><i class=\"icon-edit\"></i></button>"',
			'htmlOptions'=>array('style'=>'width: 60px')),
		// 'prodUmkm.umkm_nama:text:UMKM',
		/*
		'prod_status',
		*/
		array(
			'class'=>'CButtonColumn',
			'htmlOptions'=>array('style'=>'width: 60px'),
			'updateButtonImageUrl'=>false,
			'updateButtonLabel'=>'',
			'header'=>'...',
			// 'updateButtonUrl'=>'$this->grid->controller->createUrl("/History/update", array("id"=>$data->primaryKey,"asDialog"=>1,"gridId"=>$this->grid->id))',
		),
	),
)); ?>
</small>
