<?php
/* @var $this ProdukController */
/* @var $model Produk */

$this->breadcrumbs=array(
	'Produk'=>array('index'),
	'Item',
);

$this->menu=array(
	array('label'=>'<i class="icon-plus"></i> Tambah', 'url'=>array('create')),
	array('label'=>'<i class="icon-th-large"></i> Kelola', 'url'=>array('admin')),
);
?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'items-grid',
	'dataProvider'=>$model->onlyThisUmkm(Yii::app()->user->getUmkmId()),
	// 'dataProvider'=>$model->search(),
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
				),
	'pagerCssClass'=>'pagination',
	'columns'=>array(
		array(
			'name'=>'itemProd.prod_nama',
			'header'=>'Nama'),
		array(
			'name'=>'item_stok'),
		array(
			'class'=>'CButtonColumn',
			'htmlOptions'=>array('style'=>'min-width: 60px'),
			'header'=>'...',
			// 'updateButtonUrl'=>'$this->grid->controller->createUrl("/History/update", array("id"=>$data->primaryKey,"asDialog"=>1,"gridId"=>$this->grid->id))',
		),
	),
)); ?>
