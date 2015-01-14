<?php
/* @var $this UmkmController */
/* @var $data Umkm */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('umkm_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->umkm_id), array('view', 'id'=>$data->umkm_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('umkm_nama')); ?>:</b>
	<?php echo CHtml::encode($data->umkm_nama); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('umkm_deskripsi')); ?>:</b>
	<?php echo CHtml::encode($data->umkm_deskripsi); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('umkm_telp')); ?>:</b>
	<?php echo CHtml::encode($data->umkm_telp); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('umkm_alamat')); ?>:</b>
	<?php echo CHtml::encode($data->umkm_alamat); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('umkm_email')); ?>:</b>
	<?php echo CHtml::encode($data->umkm_email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('umkm_lokasi_kode')); ?>:</b>
	<?php echo CHtml::encode($data->umkm_lokasi_kode); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('umkm_noreg')); ?>:</b>
	<?php echo CHtml::encode($data->umkm_noreg); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('umkm_pemilik')); ?>:</b>
	<?php echo CHtml::encode($data->umkm_pemilik); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('umkm_pemilik_idcard')); ?>:</b>
	<?php echo CHtml::encode($data->umkm_pemilik_idcard); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('umkm_imgurl')); ?>:</b>
	<?php echo CHtml::encode($data->umkm_imgurl); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('umkm_tanggal')); ?>:</b>
	<?php echo CHtml::encode($data->umkm_tanggal); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('umkm_status')); ?>:</b>
	<?php echo CHtml::encode($data->umkm_status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('umkm_alias')); ?>:</b>
	<?php echo CHtml::encode($data->umkm_alias); ?>
	<br />

	*/ ?>

</div>