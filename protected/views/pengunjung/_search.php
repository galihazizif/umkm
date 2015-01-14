<?php
/* @var $this PengunjungController */
/* @var $model Pengunjung */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'pgj_id'); ?>
		<?php echo $form->textField($model,'pgj_id',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pgj_email'); ?>
		<?php echo $form->textField($model,'pgj_email',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pgj_nama'); ?>
		<?php echo $form->textField($model,'pgj_nama',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pgj_nohp'); ?>
		<?php echo $form->textField($model,'pgj_nohp',array('size'=>13,'maxlength'=>13)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pgj_lokasi'); ?>
		<?php echo $form->textField($model,'pgj_lokasi',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pgj_alamat'); ?>
		<?php echo $form->textField($model,'pgj_alamat',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pgj_lastlogin'); ?>
		<?php echo $form->textField($model,'pgj_lastlogin',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pgj_ref'); ?>
		<?php echo $form->textField($model,'pgj_ref',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pgj_status'); ?>
		<?php echo $form->textField($model,'pgj_status'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->