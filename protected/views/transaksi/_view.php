<?php
/* @var $this TransaksiController */
/* @var $data Transaksi */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('trans_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->trans_id), array('view', 'id'=>$data->trans_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('trans_kodetrans')); ?>:</b>
	<?php echo CHtml::encode($data->trans_kodetrans); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('trans_pgj_id')); ?>:</b>
	<?php echo CHtml::encode($data->trans_pgj_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('trans_item_id')); ?>:</b>
	<?php echo CHtml::encode($data->trans_item_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('trans_tanggal')); ?>:</b>
	<?php echo CHtml::encode($data->trans_tanggal); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('trans_status')); ?>:</b>
	<?php echo CHtml::encode($data->trans_status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('trans_qty')); ?>:</b>
	<?php echo CHtml::encode($data->trans_qty); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('trans_biayatambahan')); ?>:</b>
	<?php echo CHtml::encode($data->trans_biayatambahan); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('trans_keterangan')); ?>:</b>
	<?php echo CHtml::encode($data->trans_keterangan); ?>
	<br />

	*/ ?>

</div>