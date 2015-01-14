<?php
/* @var $this PengunjungController */
/* @var $data Pengunjung */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('pgj_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->pgj_id), array('view', 'id'=>$data->pgj_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pgj_email')); ?>:</b>
	<?php echo CHtml::encode($data->pgj_email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pgj_password')); ?>:</b>
	<?php echo CHtml::encode($data->pgj_password); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pgj_nama')); ?>:</b>
	<?php echo CHtml::encode($data->pgj_nama); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pgj_nohp')); ?>:</b>
	<?php echo CHtml::encode($data->pgj_nohp); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pgj_lokasi')); ?>:</b>
	<?php echo CHtml::encode($data->pgj_lokasi); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pgj_alamat')); ?>:</b>
	<?php echo CHtml::encode($data->pgj_alamat); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('pgj_lastlogin')); ?>:</b>
	<?php echo CHtml::encode($data->pgj_lastlogin); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pgj_ref')); ?>:</b>
	<?php echo CHtml::encode($data->pgj_ref); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pgj_status')); ?>:</b>
	<?php echo CHtml::encode($data->pgj_status); ?>
	<br />

	*/ ?>

</div>