<?php
/* @var $this KategoriprodukController */
/* @var $model Kategoriproduk */

$this->breadcrumbs=array(
	'Kategoriproduks'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'<i class="icon-th-large"></i> Kelola', 'url'=>array('admin')),
);
?>

<h4>Tambahkan Kategori Produk</h4>
<p>Kategori produk digunakan untuk mengkategorikan produk UMKM yang ada di  <?php echo Yii::app()->name; ?></p>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>