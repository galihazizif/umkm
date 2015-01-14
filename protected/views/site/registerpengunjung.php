<?php
/* @var $this RegisterUmkmFormController */
/* @var $model RegisterUmkmForm */
/* @var $form CActiveForm */
	$this->pageTitle=Yii::app()->name . ' - Registrasi Pengunjung';
	$this->breadcrumbs=array(
	'Registrasi Pengunjung',
);
?>


<div class="row" style="margin-bottom: 20px">
<div class="span7 offset1" style="margin-top: 30px">
		<h4 class="">Registrasi Pengujung</h4>
		<p>Silahkan mengisi <i>form</i> berikut ini untuk mendaftar.</p>
		<hr>
</div>

<div class="span8 offset1"> <!-- form -->

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'pengunjung-regsiterpengunjung-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// See class documentation of CActiveForm for details on this,
	// you need to use the performAjaxValidation()-method described there.
	'enableAjaxValidation'=>false,
)); ?>

<div class="span3">
	
	<div class="row">
		<?php echo $form->labelEx($model,'pgj_nama'); ?>
		<?php echo $form->textField($model,'pgj_nama'); ?>
		<?php echo $form->error($model,'pgj_nama',array('class'=>'cerror')); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'pgj_email'); ?>
		<?php echo $form->textField($model,'pgj_email'); ?>
		<?php echo $form->error($model,'pgj_email',array('class'=>'cerror')); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'emailconf'); ?>
		<?php echo $form->textField($model,'emailconf'); ?>
		<?php echo $form->error($model,'emailconf',array('class'=>'cerror')); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'pgj_password'); ?>
		<?php echo $form->passwordField($model,'pgj_password'); ?>
		<?php echo $form->error($model,'pgj_password',array('class'=>'cerror')); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'passconf'); ?>
		<?php echo $form->passwordField($model,'passconf'); ?>
		<?php echo $form->error($model,'passconf',array('class'=>'cerror')); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'pgj_nohp'); ?>
		<?php echo $form->textField($model,'pgj_nohp'); ?>
		<?php echo $form->error($model,'pgj_nohp',array('class'=>'cerror')); ?>
	</div>

</div>
<div class="span3">

	<div class="row">
		<?php echo $form->labelEx($model,'provinsi'); ?>
		<?php echo $form->dropDownList($model,'provinsi',$listProvinsi,array('class'=>'span3',
			'ajax'=> array(
				'type'=>'POST',
				'url'=>	CController::createUrl('site/updatekota'),
				'update'=>'#Pengunjung_kabupaten'))
		); ?>
		<?php echo $form->error($model,'provinsi',array('class'=>'cerror')); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'kabupaten'); ?>
		<?php echo $form->dropDownList($model,'kabupaten',$listKota,array('class'=>'span3',
		'ajax'=>array(
		'type'=>'POST',
		'url'=>CController::createUrl('site/updatekecamatan'),
		'update'=>'#Pengunjung_kecamatan'))); ?>
		<?php echo $form->error($model,'kabupaten', array('class'=>'cerror')); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'kecamatan'); ?>
		<?php echo $form->dropDownList($model,'kecamatan',$listKecamatan,array('class'=>'span3',
		'ajax'=>array(
		'type'=>'Post',
		'url'=>CController::createUrl('site/updatedesa'),
		'update'=>'#Pengunjung_desa'))); ?>
		<?php echo $form->error($model,'kecamatan', array('class'=>'cerror')); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'desa'); ?>
		<?php echo $form->dropDownList($model,'desa',$listDesa,array('class'=>'span3')); ?>
		<?php echo $form->error($model,'desa', array('class'=>'cerror')); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'pgj_alamat'); ?>
		<?php echo $form->textArea($model,'pgj_alamat'); ?>
		<?php echo $form->error($model,'pgj_alamat',array('class'=>'cerror')); ?>
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

	<div class="row buttons">
		<?php echo CHtml::submitButton('Simpan',array('class'=>'btn btn-primary')); ?>
	</div>

</div>


<?php $this->endWidget(); ?>

</div><!-- form -->

</div> <!-- end row -->