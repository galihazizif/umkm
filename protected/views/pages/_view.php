<?php
/* @var $this PagesController */
/* @var $data Pages */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('p_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->p_id), array('view', 'id'=>$data->p_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('p_judul')); ?>:</b>
	<?php echo CHtml::encode($data->p_judul); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('p_alias')); ?>:</b>
	<?php echo CHtml::encode($data->p_alias); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('p_isi')); ?>:</b>
	<?php echo CHtml::encode($data->p_isi); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('p_umkm_id')); ?>:</b>
	<?php echo CHtml::encode($data->p_umkm_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('p_status')); ?>:</b>
	<?php echo CHtml::encode($data->p_status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('p_kategori')); ?>:</b>
	<?php echo CHtml::encode($data->p_kategori); ?>
	<br />


</div>