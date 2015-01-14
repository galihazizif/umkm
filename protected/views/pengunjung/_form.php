<?php
/* @var $this PengunjungController */
/* @var $model Pengunjung */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'pengunjung-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="span3">
		<?php echo $form->labelEx($model,'pgj_email'); ?>
		<?php echo $form->textField($model,'pgj_email',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'pgj_email'); ?>
	</div>

	<div class="span3">
		<?php echo $form->labelEx($model,'pgj_nama'); ?>
		<?php echo $form->textField($model,'pgj_nama',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'pgj_nama'); ?>
	</div>

	<div class="span3">
		<?php echo $form->labelEx($model,'pgj_nohp'); ?>
		<?php echo $form->textField($model,'pgj_nohp',array('size'=>13,'maxlength'=>13)); ?>
		<?php echo $form->error($model,'pgj_nohp'); ?>
	</div>

	<div class="span3">
		<?php echo $form->labelEx($model,'pgj_lokasi'); ?>
		<?php echo $form->textField($model,'pgj_lokasi',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'pgj_lokasi'); ?>
	</div>

	<div class="span3">
		<?php echo $form->labelEx($model,'pgj_alamat'); ?>
		<?php echo $form->textField($model,'pgj_alamat',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'pgj_alamat'); ?>
	</div>

	<div class="span3">
		<?php echo $form->labelEx($model,'pgj_lastlogin'); ?>
		<?php echo $form->textField($model,'pgj_lastlogin',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'pgj_lastlogin'); ?>
	</div>


	<div class="span7">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->