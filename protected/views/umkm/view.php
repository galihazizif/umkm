<?php
/* @var $this UmkmController */
/* @var $model Umkm */

$this->breadcrumbs=array(
	'Umkms'=>array('index'),
	$model->umkm_id,
);

$this->menu=array(
	array('label'=>'<i class="icon-plus"></i> Tambah', 'url'=>array('create')),
	array('label'=>'<i class="icon-edit"></i> Sunting', 'url'=>array('update', 'id'=>$model->umkm_id)),
	array('label'=>'<i class="icon-remove"></i> Hapus', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->umkm_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'<i class="icon-th-large"></i> Kelola', 'url'=>array('admin')),
);
?>

<h4>Rincian tentang  <?php echo $model->umkm_nama; ?></h4>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'htmlOptions'=>array('class'=>'table table-condensed table-hover'),
	'attributes'=>array(
		'umkm_nama',
		'umkm_deskripsi',
		'umkm_telp',
		'umkm_email',
		array(
			'name'=>'umkm_lokasi_kode',
			'value'=>$model->umkmLokasiKode->alamatLengkap()),
		'umkm_alamat',
		'umkm_noreg',
		'umkm_pemilik',
		'umkm_pemilik_idcard',
		'umkm_imgurl',
		'umkm_tanggal',
		array(
			'name'=>'umkm_status',
			'value'=>$model->getStatusLabel()),
		'umkm_alias',
	),
)); ?>
