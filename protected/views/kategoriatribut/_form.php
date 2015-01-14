<?php
/* @var $this KategoriatributController */
/* @var $model Kategoriatribut */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'kategoriatribut-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="span3">
		<?php echo $form->labelEx($model,'ka_id'); ?>
		<?php echo $form->textField($model,'ka_id',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'ka_id'); ?>
	</div>

	<div class="span3">
		<?php echo $form->labelEx($model,'ka_nama'); ?>
		<?php echo $form->textField($model,'ka_nama',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'ka_nama'); ?>
	</div>

	<div class="span7 buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->