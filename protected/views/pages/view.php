<?php
/* @var $this PagesController */
/* @var $model Pages */

$this->breadcrumbs=array(
	'Pages'=>array('index'),
	$model->p_id,
);

$this->menu=array(
	array('label'=>'<i class="icon-plus"></i> Tambah', 'url'=>array('create')),
	array('label'=>'<i class="icon-edit"></i> Sunting', 'url'=>array('update', 'id'=>$model->p_id)),
	array('label'=>'<i class="icon-remove"></i> Hapus', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->p_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'<i class="icon-th-large"></i> Kelola', 'url'=>array('admin')),
);?>

<h4>Halaman "<?php echo $model->p_judul; ?>"</h4>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'htmlOptions'=>array('class'=>'table table-condensed'),
	'attributes'=>array(
		'p_judul',
		'p_isi:html',
		array(
			'name'=>'p_status',
			'value'=> $model->getStatusLabel()),
	),
)); ?>
