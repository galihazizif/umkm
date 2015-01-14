<?php
/* @var $this ProdukController */
/* @var $data Produk */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('prod_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->prod_id), array('view', 'id'=>$data->prod_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('prod_nama')); ?>:</b>
	<?php echo CHtml::encode($data->prod_nama); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('prod_deskripsi')); ?>:</b>
	<?php echo CHtml::encode($data->prod_deskripsi); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('prod_kat_id')); ?>:</b>
	<?php echo CHtml::encode($data->prod_kat_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('prod_harga')); ?>:</b>
	<?php echo CHtml::encode($data->prod_harga); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('prod_umkm_id')); ?>:</b>
	<?php echo CHtml::encode($data->prod_umkm_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('prod_status')); ?>:</b>
	<?php echo CHtml::encode($data->prod_status); ?>
	<br />


</div>