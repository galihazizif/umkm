<?php
/* @var $this PagesController */
/* @var $model Pages */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'pages-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<div class="row">
		<div class="span5">
			<?php echo $form->labelEx($model,'p_judul'); ?>
			<?php echo $form->textField($model,'p_judul',array('size'=>60,'maxlength'=>70)); ?>
			<?php echo $form->error($model,'p_judul',array('class'=>'cerror')); ?>
		</div>
	</div>

	<div class="row">
		<div class="span5">
			<?php echo $form->labelEx($model,'p_isi'); ?>
			<?php echo $form->textArea($model,'p_isi',array('class'=>'span6','rows'=>'8')); ?>
			<?php echo $form->error($model,'p_isi',array('class'=>'cerror')); ?>
		</div>
	</div>

	<div class="row">
		<div class="span5">
			<?php echo $form->labelEx($model,'p_status'); ?>
			<?php echo $form->dropDownList($model,'p_status',array(
				Pages::STATUS_UNPUBLISHED=>'Unpublished',
				Pages::STATUS_PUBLISHED => 'Published')); ?>
			<?php echo $form->error($model,'p_status',array('class'=>'cerror')); ?>
		</div>
	</div>

	<div class="row buttons">
		<div class="span3">
			<?php echo CHtml::submitButton($model->isNewRecord ? 'Tambahkan' : 'Simpan',array('class'=>'btn btn-primary')); ?>
		</div>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->