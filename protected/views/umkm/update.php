<?php
/* @var $this UmkmController */
/* @var $model Umkm */

$this->breadcrumbs=array(
	'Umkms'=>array('index'),
	$model->umkm_id=>array('view','id'=>$model->umkm_id),
	'Update',
);

$this->menu=array(
	array('label'=>'<i class="icon-plus"></i> Tambah', 'url'=>array('create')),
	array('label'=>'<i class="icon-th-large"></i> Kelola', 'url'=>array('admin')),
);
?>

<h4>Sunting Profil <?php echo $model->umkm_nama; ?></h4>
<p>Profil UMKM boleh diubah oleh System Adimistrator hanya jika diminta oleh pengelola UMKM.</p>

<?php $this->renderPartial('_form', array(
	'model'=>$model,
	'listProvinsi'=>$listProvinsi,
	'listKota'=>$listKota,
	'listKecamatan'=>$listKecamatan,
	'listDesa'=>$listDesa,
	)); ?>