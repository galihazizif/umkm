<?php
/* @var $this ProdukController */
/* @var $model Produk */

$this->breadcrumbs=array(
	'Produk'=>array('index'),
	'Tambah',
);

$this->menu=array(
	array('label'=>'<i class="icon-plus"></i> Tambah', 'url'=>array('create')),
	array('label'=>'<i class="icon-th-large"></i> Kelola', 'url'=>array('admin')),
);
?>

<h5>Tambah Produk</h5>

<?php $this->renderPartial('_form', array(
	'model'=>$model,
	'kategori'=>$kategori)); ?>