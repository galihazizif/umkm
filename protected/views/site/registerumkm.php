<?php
/* @var $this RegisterUmkmFormController */
/* @var $model RegisterUmkmForm */
/* @var $form CActiveForm */
	$this->pageTitle=Yii::app()->name . ' - Registrasi UMKM';
	$this->breadcrumbs=array(
	'Registrasi UMKM',
);
?>


<div class="row" style="margin-bottom: 20px">
<div class="span7 offset1" style="margin-top: 30px">
		<h4 class="">Registrasi UMKM</h4>
		<p>Silahkan isi form berikut ini untuk mendaftarkan UMKM anda.</p>
		<hr>
</div>

<div class="span10 offset1"> <!-- form -->

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'register-umkm-form',
	'enableAjaxValidation'=>false,
	'enableClientValidation'=>false,
	'clientOptions'=>array(
		'validateOnSubmit'=>true)
)); ?>

<div class="span3">
	
	<div class="row">
		<?php echo $form->labelEx($model,'umkm_nama'); ?>
		<?php echo $form->textField($model,'umkm_nama',array('class'=>'span3','placeholder'=>'Masukkan nama usaha anda')); ?>
		<?php echo $form->error($model,'umkm_nama', array('class'=>'cerror')); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'umkm_deskripsi'); ?>
		<?php echo $form->textArea($model,'umkm_deskripsi',array('class'=>'span3','placeholder'=>'Penjelasan singkat mengenai usaha anda')); ?>
		<?php echo $form->error($model,'umkm_deskripsi', array('class'=>'cerror')); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'provinsi'); ?>
		<?php echo $form->dropDownList($model,'provinsi',$listProvinsi,array('class'=>'span3',
			'ajax'=> array(
				'type'=>'POST',
				'url'=>	CController::createUrl('site/updatekota'),
				'update'=>'#RegisterUmkmForm_kabupaten'))
		); ?>
		<?php echo $form->error($model,'provinsi', array('class'=>'cerror')); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'kabupaten'); ?>
		<?php echo $form->dropDownList($model,'kabupaten',$listKota,array('class'=>'span3',
		'ajax'=>array(
		'type'=>'POST',
		'url'=>CController::createUrl('site/updatekecamatan'),
		'update'=>'#RegisterUmkmForm_kecamatan'))); ?>
		<?php echo $form->error($model,'kabupaten', array('class'=>'cerror')); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'kecamatan'); ?>
		<?php echo $form->dropDownList($model,'kecamatan',$listKecamatan,array('class'=>'span3',
		'ajax'=>array(
		'type'=>'Post',
		'url'=>CController::createUrl('site/updatedesa'),
		'update'=>'#RegisterUmkmForm_desa'))); ?>
		<?php echo $form->error($model,'kecamatan', array('class'=>'cerror')); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'desa'); ?>
		<?php echo $form->dropDownList($model,'desa',$listDesa,array('class'=>'span3')); ?>
		<?php echo $form->error($model,'desa', array('class'=>'cerror')); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'umkm_alias'); ?>
		<?php echo $form->textField($model,'umkm_alias',array('class'=>'span3','placeholder'=>'alias UMKM Anda')); ?>
		<small>Dengan mengisi alias, halaman UMKM anda dapat diakses di: <code><?php print $this->createAbsoluteUrl('aliasUmkmAnda/');?></code></small>
		<?php echo $form->error($umkm,'umkm_alias', array('class'=>'cerror')); ?>
	</div>

	<div class="row">
		<?php echo CHtml::submitButton('Simpan',array('class'=>'btn btn-primary','style'=>'margin-top: 25px')); ?>
	</div>
</div>
<div class="span3">

	<div class="row">
		<?php echo $form->labelEx($model,'umkm_email'); ?>
		<?php echo $form->textField($model,'umkm_email',array('class'=>'span3','placeholder'=>'Masukkan email anda')); ?>
		<?php echo $form->error($model,'umkm_email', array('class'=>'cerror')); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cemail'); ?>
		<?php echo $form->textField($model,'cemail',array('class'=>'span3','placeholder'=>'Konfirmasi email ')); ?>
		<?php echo $form->error($model,'cemail', array('class'=>'cerror')); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'umkm_password'); ?>
		<?php echo $form->passwordField($model,'umkm_password',array('placeholder'=>'Password untuk akun anda')); ?>
		<?php echo $form->error($model,'umkm_password', array('class'=>'cerror')); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cpassword'); ?>
		<?php echo $form->passwordField($model,'cpassword', array('class'=>'cerror','placeholder'=>'Konfirmasi password')); ?>
		<?php echo $form->error($model,'cpassword'); ?>
	</div>

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
	<div class="row">
		<small>
		Dengan dilakukannya registrasi untuk menggunakan layanan ini, saya (pengguna) menyetujui seluruh isi <a href="<?php print $this->createUrl('site/page',array('view'=>'syaratketentuan'))?>">Syarat dan Ketentuan</a> yang berlaku tanpa terkecuali.
	</small>
	</div>
</div>


<?php $this->endWidget(); ?>

</div><!-- form -->

</div> <!-- end row -->