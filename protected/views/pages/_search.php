<?php
/* @var $this PagesController */
/* @var $model Pages */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'p_id'); ?>
		<?php echo $form->textField($model,'p_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'p_judul'); ?>
		<?php echo $form->textField($model,'p_judul',array('size'=>60,'maxlength'=>70)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'p_alias'); ?>
		<?php echo $form->textField($model,'p_alias',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'p_isi'); ?>
		<?php echo $form->textArea($model,'p_isi',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'p_umkm_id'); ?>
		<?php echo $form->textField($model,'p_umkm_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'p_status'); ?>
		<?php echo $form->textField($model,'p_status'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'p_kategori'); ?>
		<?php echo $form->textField($model,'p_kategori',array('size'=>5,'maxlength'=>5)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->