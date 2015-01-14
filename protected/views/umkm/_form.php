<?php
/* @var $this UmkmController */
/* @var $model Umkm */
/* @var $form CActiveForm */

$dropDown = array(
	Umkm::STATUS_REGISTERED =>'Belum Terverifikasi',
	Umkm::STATUS_VERIFIED =>'Terverifikasi',
	Umkm::STATUS_SUSPENDED =>'Non-Aktif',
	)
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'umkm-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="span3">
		<?php echo $form->labelEx($model,'umkm_nama'); ?>
		<?php echo $form->textField($model,'umkm_nama',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'umkm_nama',array('class'=>'cerror')); ?>
	</div>

	<div class="span3">
		<?php echo $form->labelEx($model,'umkm_deskripsi'); ?>
		<?php echo $form->textArea($model,'umkm_deskripsi',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'umkm_deskripsi',array('class'=>'cerror')); ?>
	</div>

	<div class="span3">
		<?php echo $form->labelEx($model,'umkm_telp'); ?>
		<?php echo $form->textField($model,'umkm_telp',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'umkm_telp',array('class'=>'cerror')); ?>
	</div>

	<div class="span3">
		<?php echo $form->labelEx($model,'umkm_email'); ?>
		<?php echo $form->textField($model,'umkm_email',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'umkm_email',array('class'=>'cerror')); ?>
		<?php echo isset($admin)?$form->error($admin,'admin_email',array('class'=>'cerror')):''; ?>
	</div>

	<div class="span7">
		<?php echo $form->labelEx($model,'provinsi'); ?>
		<?php echo $form->dropDownList($model,'provinsi',$listProvinsi,array('class'=>'span3',
			'ajax'=> array(
				'type'=>'POST',
				'url'=>	CController::createUrl('site/updatekota'),
				'update'=>'#Umkm_kabupaten'))
		); ?>
		<?php echo $form->error($model,'provinsi',array('class'=>'cerror')); ?>
	</div>
	<div class="span7">
		<?php echo $form->labelEx($model,'kabupaten'); ?>
		<?php echo $form->dropDownList($model,'kabupaten',$listKota,array('class'=>'span3',
		'ajax'=>array(
		'type'=>'POST',
		'url'=>CController::createUrl('site/updatekecamatan'),
		'update'=>'#Umkm_kecamatan'))); ?>
		<?php echo $form->error($model,'kabupaten', array('class'=>'cerror')); ?>
	</div>

	<div class="span7">
		<?php echo $form->labelEx($model,'kecamatan'); ?>
		<?php echo $form->dropDownList($model,'kecamatan',$listKecamatan,array('class'=>'span3',
		'ajax'=>array(
		'type'=>'Post',
		'url'=>CController::createUrl('site/updatedesa'),
		'update'=>'#Umkm_desa'))); ?>
		<?php echo $form->error($model,'kecamatan', array('class'=>'cerror')); ?>
	</div>

	<div class="span7">
		<?php echo $form->labelEx($model,'desa'); ?>
		<?php echo $form->dropDownList($model,'desa',$listDesa,array('class'=>'span3')); ?>
		<?php echo $form->error($model,'desa', array('class'=>'cerror')); ?>
	</div>

	<div class="span3">
		<?php echo $form->labelEx($model,'umkm_alamat'); ?>
		<?php echo $form->textArea($model,'umkm_alamat',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'umkm_alamat',array('class'=>'cerror')); ?>
	</div>

	<div class="span3">
		<?php echo $form->labelEx($model,'umkm_noreg'); ?>
		<?php echo $form->textField($model,'umkm_noreg',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'umkm_noreg',array('class'=>'cerror')); ?>
	</div>

	<div class="span3">
		<?php echo $form->labelEx($model,'umkm_pemilik'); ?>
		<?php echo $form->textField($model,'umkm_pemilik',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'umkm_pemilik',array('class'=>'cerror')); ?>
	</div>

	<div class="span3">
		<?php echo $form->labelEx($model,'umkm_pemilik_idcard'); ?>
		<?php echo $form->textField($model,'umkm_pemilik_idcard',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'umkm_pemilik_idcard',array('class'=>'cerror')); ?>
	</div>

	<div class="span3">
		<?php echo $form->labelEx($model,'umkm_imgurl'); ?>
		<?php echo $form->textField($model,'umkm_imgurl',array('size'=>60,'maxlength'=>125)); ?>
		<?php echo $form->error($model,'umkm_imgurl',array('class'=>'cerror')); ?>
	</div>

	<div class="span3">
		<?php echo $form->labelEx($model,'umkm_status'); ?>
		<?php echo $form->dropDownList($model,'umkm_status',$dropDown); ?>
		<?php echo $form->error($model,'umkm_status',array('class'=>'cerror')); ?>
	</div>

	<div class="span3">
		<?php echo $form->labelEx($model,'umkm_alias'); ?>
		<?php echo $form->textField($model,'umkm_alias',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'umkm_alias',array('class'=>'cerror')); ?>
	</div>

	<div class="span3 buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Simpan' : 'Simpan',array('class'=>'btn btn-primary')); ?>
		<br><br><br>
	</div>

<?php $this->endWidget(); ?>


</div><!-- form -->