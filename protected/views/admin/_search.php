<?php
/* @var $this AdminController */
/* @var $model Admin */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'admin_id'); ?>
		<?php echo $form->textField($model,'admin_id',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'admin_email'); ?>
		<?php echo $form->textField($model,'admin_email',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'admin_regdate'); ?>
		<?php echo $form->textField($model,'admin_regdate',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'admin_lastlogin'); ?>
		<?php echo $form->textField($model,'admin_lastlogin',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'admin_umkm_id'); ?>
		<?php echo $form->textField($model,'admin_umkm_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'admin_isowner'); ?>
		<?php echo $form->textField($model,'admin_isowner'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'admin_status'); ?>
		<?php echo $form->textField($model,'admin_status'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->