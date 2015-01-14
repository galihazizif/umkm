<?php
/* @var $this ProdukController */
/* @var $model Produk */

$this->breadcrumbs=array(
	'Produk'=>array('index'),
	$model->prod_id=>array('view','id'=>$model->prod_id),
	'Sunting',
);

$this->menu=array(
	array('label'=>'<i class="icon-plus"></i> Tambah', 'url'=>array('create')),
	array('label'=>'<i class="icon-th-large"></i> Kelola', 'url'=>array('admin')),
);
?>

<h3>Update Produk <?php echo $model->prod_nama; ?></h3>

<?php $this->renderPartial('_form', array(
	'model'=>$model,
	'kategori'=>$kategori)); ?>