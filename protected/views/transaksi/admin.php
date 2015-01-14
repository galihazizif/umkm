<?php
/* @var $this TransaksiController */
/* @var $model Transaksi */

$this->breadcrumbs=array(
	'Transaksi'=>array('index'),
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
	$('#transaksi-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h4>Daftar Transaksi</h4>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<small>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'transaksi-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'itemsCssClass'=>'table table-bordered table-condensed table-hover sidemenu',
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
	'htmlOptions'=>'',
	'columns'=>array(
		array(
			'name'=>'trans_kodetrans',
			'type'=>'url',
			'value'=>'$data->trans_kodetrans',
			'htmlOptions'=>array('style'=>'width: 140px'),
			'header'=>'Kode Transaksi'),
		array(
			'name'=>'transPgj.pgj_nama',
			'type'=>'text',
			'value'=>'substr($data->transPgj->pgj_nama,0,10)."..."',
			'header'=>'Nama'),
		array(
			'name'=>'transItem.itemProd.prodUmkm.umkm_nama',
			'type'=>'text',
			'value'=>'substr($data->transItem->itemProd->prodUmkm->umkm_nama,0,10)."..."',
			'header'=>'UMKM'),
		array(
			'name'=>'trans_tanggal',
			'type'=>'text',
			'value'=>'date_format(date_create($data->trans_tanggal),"d M Y / H:i:s");',
			'htmlOptions'=>array('style'=>'width: 140px'),
			'header'=>'Tanggal'),
		array(
			'name'=>'trans_status',
			'type'=>'text',
			'value'=>'$data->getStatusLabel()',
			'header'=>'Status',
			'htmlOptions'=>array('style'=>'width: 110px')),
		/*
		'trans_qty',
		'trans_biayatambahan',
		'trans_keterangan',
		*/
		array(
			'class'=>'CButtonColumn',
			'updateButtonImageUrl'=>false,
			'updateButtonLabel'=>'',
			'deleteButtonImageUrl'=>false,
			'deleteButtonLabel'=>'',
		),
		)
)); ?>
</small>
