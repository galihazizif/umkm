<?php
/* @var $this AdminController */
/* @var $data Admin */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('admin_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->admin_id), array('view', 'id'=>$data->admin_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('admin_email')); ?>:</b>
	<?php echo CHtml::encode($data->admin_email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('admin_password')); ?>:</b>
	<?php echo CHtml::encode($data->admin_password); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('admin_regdate')); ?>:</b>
	<?php echo CHtml::encode($data->admin_regdate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('admin_lastlogin')); ?>:</b>
	<?php echo CHtml::encode($data->admin_lastlogin); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('admin_umkm_id')); ?>:</b>
	<?php echo CHtml::encode($data->admin_umkm_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('admin_isowner')); ?>:</b>
	<?php echo CHtml::encode($data->admin_isowner); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('admin_status')); ?>:</b>
	<?php echo CHtml::encode($data->admin_status); ?>
	<br />

	*/ ?>

</div>