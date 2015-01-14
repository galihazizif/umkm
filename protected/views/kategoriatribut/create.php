<?php
/* @var $this KategoriatributController */
/* @var $model Kategoriatribut */

$this->breadcrumbs=array(
	'Kategoriatributs'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'<i class="icon-th-large"></i> Kelola', 'url'=>array('admin')),
);
?>

<h4>Tambah kategori atribut</h4>
<p>
Kategori ini digunakan untuk menamai berbagai macam atribut untuk setiap akun UMKM seperti Jenis Nomor Rekening, jenis kontak dsb.
</p>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>