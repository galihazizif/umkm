<?php
/* @var $this TransaksiController */
/* @var $model Transaksi */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'transaksi-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'trans_kodetrans'); ?>
		<?php echo $form->textField($model,'trans_kodetrans',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'trans_kodetrans'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'trans_pgj_id'); ?>
		<?php echo $form->textField($model,'trans_pgj_id',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'trans_pgj_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'trans_item_id'); ?>
		<?php echo $form->textField($model,'trans_item_id',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'trans_item_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'trans_tanggal'); ?>
		<?php echo $form->textField($model,'trans_tanggal'); ?>
		<?php echo $form->error($model,'trans_tanggal'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'trans_status'); ?>
		<?php echo $form->textField($model,'trans_status'); ?>
		<?php echo $form->error($model,'trans_status'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'trans_qty'); ?>
		<?php echo $form->textField($model,'trans_qty',array('size'=>4,'maxlength'=>4)); ?>
		<?php echo $form->error($model,'trans_qty'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'trans_biayatambahan'); ?>
		<?php echo $form->textField($model,'trans_biayatambahan',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'trans_biayatambahan'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'trans_keterangan'); ?>
		<?php echo $form->textField($model,'trans_keterangan',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'trans_keterangan'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->