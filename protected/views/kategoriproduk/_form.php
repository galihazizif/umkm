<?php
/* @var $this KategoriprodukController */
/* @var $model Kategoriproduk */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'kategoriproduk-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="span3">
		<?php echo $form->labelEx($model,'kat_id'); ?>
		<?php echo $form->textField($model,'kat_id',array('size'=>7,'maxlength'=>7)); ?>
		<?php echo $form->error($model,'kat_id'); ?>
	</div>

	<div class="span3">
		<?php echo $form->labelEx($model,'kat_nama'); ?>
		<?php echo $form->textField($model,'kat_nama',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'kat_nama'); ?>
	</div>

	<div class="span3">
		<?php echo $form->labelEx($model,'kat_status'); ?>
		<?php echo $form->dropDownList($model,'kat_status',array(
			Kategoriproduk::STATUS_AKTIF=>'Aktif',
			Kategoriproduk::STATUS_TDK_AKTIF=>'Tidak Aktif')); ?>
		<?php echo $form->error($model,'kat_status'); ?>
	</div>

	<div class="span7">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->