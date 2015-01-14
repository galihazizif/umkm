<?php
/* @var $this PagesController */
/* @var $model Pages */

$this->breadcrumbs=array(
	'Pages'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'<i class="icon-plus"></i> Tambah', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#pages-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h4>Pengelolaan halaman</h4>
<?php if(Yii::app()->user->isSysAdmin()):?>
<?php endif;?>
<?php if(Yii::app()->user->isUmkm()):?>
<p>Anda bisa menambahkan halaman tambahan untuk mengenalkan UMKM anda kepada pengunjung. Halaman ini bisa berisi tentang profil, tujuan, pengalaman usaha dan sebagainya.</p>
<?php endif;?>

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'pages-grid',
	'htmlOptions'=>array('class'=>''),
	'itemsCssClass'=>'table table-bordered table-condensed table-hover sidemenu	',
	'dataProvider'=>(Yii::app()->user->isSysAdmin())? $model->searchAll(): $model->search(),
	// 'filter'=>$model,
	'columns'=>array(
		'p_judul',
		'p_alias',
		array(
			'name'=>'pUmkm.umkm_nama',
			'value'=>'$data->pUmkm->umkm_nama',
			'type'=>'text',
			'visible'=>Yii::app()->user->isSysAdmin(),
			),
		array(
			'name'=>'p_status',
			'value'=>'$data->getStatusLabel()'),
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
