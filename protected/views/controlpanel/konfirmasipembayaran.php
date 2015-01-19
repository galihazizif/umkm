<?php
/* @var $this KonfirmasiPembayaranController */
/* @var $model KonfirmasiPembayaran */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'konfirmasi-pembayaran-konfirmasipembayaran-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// See class documentation of CActiveForm for details on this,
	// you need to use the performAjaxValidation()-method described there.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'kodetransaksi'); ?>
		<?php echo $form->textField($model,'kodetransaksi'); ?>
		<?php echo $form->error($model,'kodetransaksi'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'rekeningtujuan'); ?>
		<?php echo $form->textField($model,'rekeningtujuan'); ?>
		<?php echo $form->error($model,'rekeningtujuan'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nominal'); ?>
		<?php echo $form->textField($model,'nominal'); ?>
		<?php echo $form->error($model,'nominal'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'rekeningasal'); ?>
		<?php echo $form->textField($model,'rekeningasal'); ?>
		<?php echo $form->error($model,'rekeningasal'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'pemilikrekening'); ?>
		<?php echo $form->textField($model,'pemilikrekening'); ?>
		<?php echo $form->error($model,'pemilikrekening'); ?>
	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->