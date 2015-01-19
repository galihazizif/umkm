<?php
/* @var $this AtributController */
/* @var $data Atribut */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('at_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->at_id), array('view', 'id'=>$data->at_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('at_kategori_id')); ?>:</b>
	<?php echo CHtml::encode($data->at_kategori_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('at_umkm_id')); ?>:</b>
	<?php echo CHtml::encode($data->at_umkm_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('at_text')); ?>:</b>
	<?php echo CHtml::encode($data->at_text); ?>
	<br />


</div>