<?php
/* @var $this PengunjungController */
/* @var $model Pengunjung */

$this->breadcrumbs=array(
	'Pengunjungs'=>array('index'),
	$model->pgj_id,
);

$this->menu=array(
	// array('label'=>'<i class="icon-edit"></i> Sunting', 'url'=>array('update', 'id'=>$model->pgj_id)),
	array('label'=>'<i class="icon-remove"></i> Hapus', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->pgj_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'<i class="icon-th-large"></i> Kelola', 'url'=>array('admin')),
);
?>

<h4>Informasi pengunjung "<?php echo $model->pgj_email; ?>"</h4>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'htmlOptions'=>array('class'=>'table table-condensed'),
	'attributes'=>array(
		'pgj_email',
		'pgj_nama',
		'pgj_nohp',
		array(
			'name'=>'pgj_lokasi',
			'value'=>$model->pgjLokasiKode->alamatLengkap()),
		'pgj_alamat',
	),
)); ?>
