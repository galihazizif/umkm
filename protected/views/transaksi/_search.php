<?php
/* @var $this TransaksiController */
/* @var $model Transaksi */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'trans_id'); ?>
		<?php echo $form->textField($model,'trans_id',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'trans_kodetrans'); ?>
		<?php echo $form->textField($model,'trans_kodetrans',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'trans_pgj_id'); ?>
		<?php echo $form->textField($model,'trans_pgj_id',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'trans_item_id'); ?>
		<?php echo $form->textField($model,'trans_item_id',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'trans_tanggal'); ?>
		<?php echo $form->textField($model,'trans_tanggal'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'trans_status'); ?>
		<?php echo $form->textField($model,'trans_status'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'trans_qty'); ?>
		<?php echo $form->textField($model,'trans_qty',array('size'=>4,'maxlength'=>4)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'trans_biayatambahan'); ?>
		<?php echo $form->textField($model,'trans_biayatambahan',array('size'=>5,'maxlength'=>5)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'trans_keterangan'); ?>
		<?php echo $form->textField($model,'trans_keterangan',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->