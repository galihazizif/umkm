<?php
/* @var $this AtributController */
/* @var $model Atribut */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'atribut-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'at_kategori_id'); ?>
		<?php echo $form->textField($model,'at_kategori_id',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'at_kategori_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'at_umkm_id'); ?>
		<?php echo $form->textField($model,'at_umkm_id'); ?>
		<?php echo $form->error($model,'at_umkm_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'at_text'); ?>
		<?php echo $form->textField($model,'at_text',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'at_text'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->