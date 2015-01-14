<?php
/* @var $this UmkmController */
/* @var $model Umkm */
/* @var $form CActiveForm */

$this->breadcrumbs=array(
	'Edit Profil Pengunjung',
);
$this->pageTitle = Yii::app()->name.' - Edit Profil Pengunjung';
?>
<div class="row">
	<div class="span7">
		<h4>Sunting Profil Anda</h4>
		<hr>
	</div>
</div>

<div class="span8"> <!-- form -->

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'pengunjung-regsiterpengunjung-form',
	'enableAjaxValidation'=>false,
)); ?>

<?php echo $form->errorSummary($model);?>

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

	<div class="row buttons">
		<?php echo CHtml::submitButton('Simpan',array('class'=>'btn btn-primary')); ?>
		<a class="btn" href="<?php echo $this->createUrl('controlpanel/index')?>">Kembali</a>
	</div>
	<br>

</div>


<?php $this->endWidget(); ?>

</div><!-- form -->