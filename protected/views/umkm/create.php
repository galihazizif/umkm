<?php
/* @var $this UmkmController */
/* @var $model Umkm */

$this->breadcrumbs=array(
	'Umkms'=>array('index'),
	'Create',
);

$admin = isset($admin)? $admin: null;

$this->menu=array(
	array('label'=>'<i class="icon-plus"></i> Tambah', 'url'=>array('create')),
	array('label'=>'<i class="icon-th-large"></i> Kelola', 'url'=>array('admin')),
);
?>

<h4>Tambahkan UMKM</h4>
<p>System Administrator dapat menambahkan UMKM apabila pemilik UMKM sedang berhalangan/memiliki keterbatasan untuk melakukan pendaftaran.</p>



<?php $this->renderPartial('_form', array(
		'model'=>$model,
		'listProvinsi'=>$listProvinsi,
		'listKota'=>$listKota,
		'listKecamatan'=>$listKecamatan,
		'listDesa'=>$listDesa,
		'admin'=>$admin,
	)); ?>