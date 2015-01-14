<?php
/* @var $this KategoriprodukController */
/* @var $model Kategoriproduk */

$this->breadcrumbs=array(
	'Kategoriproduks'=>array('index'),
	$model->kat_id=>array('view','id'=>$model->kat_id),
	'Update',
);

$this->menu=array(
	array('label'=>'<i class="icon-plus"></i> Tambah', 'url'=>array('create')),
	array('label'=>'<i class="icon-th-large"></i> Kelola', 'url'=>array('admin')),
);
?>

<h4>Perbarui Kategori Produk <span class="label"><?php echo $model->kat_id; ?></span></h4>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>