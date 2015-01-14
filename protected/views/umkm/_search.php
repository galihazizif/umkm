<?php
/* @var $this UmkmController */
/* @var $model Umkm */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'umkm_id'); ?>
		<?php echo $form->textField($model,'umkm_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'umkm_nama'); ?>
		<?php echo $form->textField($model,'umkm_nama',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'umkm_deskripsi'); ?>
		<?php echo $form->textField($model,'umkm_deskripsi',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'umkm_telp'); ?>
		<?php echo $form->textField($model,'umkm_telp',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'umkm_alamat'); ?>
		<?php echo $form->textField($model,'umkm_alamat',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'umkm_email'); ?>
		<?php echo $form->textField($model,'umkm_email',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'umkm_lokasi_kode'); ?>
		<?php echo $form->textField($model,'umkm_lokasi_kode',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'umkm_noreg'); ?>
		<?php echo $form->textField($model,'umkm_noreg',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'umkm_pemilik'); ?>
		<?php echo $form->textField($model,'umkm_pemilik',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'umkm_pemilik_idcard'); ?>
		<?php echo $form->textField($model,'umkm_pemilik_idcard',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'umkm_imgurl'); ?>
		<?php echo $form->textField($model,'umkm_imgurl',array('size'=>60,'maxlength'=>125)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'umkm_tanggal'); ?>
		<?php echo $form->textField($model,'umkm_tanggal'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'umkm_status'); ?>
		<?php echo $form->textField($model,'umkm_status'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'umkm_alias'); ?>
		<?php echo $form->textField($model,'umkm_alias',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->