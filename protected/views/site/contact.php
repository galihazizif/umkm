<?php
/* @var $this SiteController */
/* @var $model ContactForm */
/* @var $form CActiveForm */

$this->pageTitle=Yii::app()->name . ' - Hubungi Kami';
$this->breadcrumbs=array(
	'Kontak',
);
?>
<br>
<div class="row offset1">
<div class="span7">
<h4>Hubungi Kami</h4>

<?php if(Yii::app()->user->hasFlash('info')): ?>

<div class="flash-success">
	<?php echo Yii::app()->user->getFlash('info'); ?>
</div>

<?php else: ?>

<p>
Jika anda mempunyai kritik, saran, keluhan atau hal lain jangan sungkan untuk menghubungi pengelola <?php echo Yii::app()->name; ?> melalui form dibawah ini.
</p>

<div class="span7">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'contact-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<p class="note">Kolom dengan <span class="required">*</span> harus diisi.</p>

	<?php if(Yii::app()->user->isGuest): ?>
	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('class'=>'span3')); ?>
		<?php echo $form->error($model,'name',array('class'=>'cerror')); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('class'=>'span3')); ?>
		<?php echo $form->error($model,'email',array('class'=>'cerror')); ?>
	</div>
	<?php endif;?>


	<div class="row">
		<?php echo $form->labelEx($model,'subject'); ?>
		<?php echo $form->textField($model,'subject',array('class'=>'span4')); ?>
		<?php echo $form->error($model,'subject',array('class'=>'cerror')); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'body'); ?>
		<?php echo $form->textArea($model,'body',array('class'=>'span4','style'=>'height: 150px')); ?>
		<?php echo $form->error($model,'body',array('class'=>'cerror')); ?>
	</div>

	<?php if(CCaptcha::checkRequirements()): ?>
	<div class="row">
		<?php $this->widget('CCaptcha', array(
			'buttonOptions'=>array('class'=>'btn','style'=>'margin-left: 3px'),
			'buttonLabel'=>'<i class="icon-refresh"><i>',
			'imageOptions'=>array('class'=>'img-polaroid'))
			); ?>
		<?php echo $form->labelEx($model,'verifyCode'); ?>
		<?php echo $form->textField($model,'verifyCode',array('placeholder'=>'Masukkan captcha')); ?>
		<?php echo $form->error($model,'verifyCode', array('class'=>'cerror')); ?>
	</div>
	<?php endif; ?>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Kirimkan',array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<?php endif; ?>
</div>
</div>