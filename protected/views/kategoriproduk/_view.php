<?php
/* @var $this KategoriprodukController */
/* @var $data Kategoriproduk */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('kat_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->kat_id), array('view', 'id'=>$data->kat_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kat_nama')); ?>:</b>
	<?php echo CHtml::encode($data->kat_nama); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kat_status')); ?>:</b>
	<?php echo CHtml::encode($data->kat_status); ?>
	<br />


</div>