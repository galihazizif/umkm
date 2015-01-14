<?php
/* @var $this KategoriatributController */
/* @var $data Kategoriatribut */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ka_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ka_id), array('view', 'id'=>$data->ka_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ka_nama')); ?>:</b>
	<?php echo CHtml::encode($data->ka_nama); ?>
	<br />


</div>