<?php
/* @var $this UmkmController */
/* @var $model Umkm */
/* @var $form CActiveForm */

$this->breadcrumbs=array(
	'Edit Umkm',
);
$this->pageTitle = Yii::app()->name.' - Edit Umkm';
?>
<div class="row">
	<div class="span7">
		<h4>Sunting Profil UMKM</h4>
		<hr>
	</div>
</div>

<div class="span3">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'umkm-editumkm-form',
	'htmlOptions'=>array('enctype'=>'multipart/form-data'),
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// See class documentation of CActiveForm for details on this,
	// you need to use the performAjaxValidation()-method described there.
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model);?>

	<div class="row">
		<?php echo $form->labelEx($model,'umkm_nama'); ?>
		<?php echo $form->textField($model,'umkm_nama'); ?>
		<?php echo $form->error($model,'umkm_nama',array('class'=>'cerror')); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'umkm_alias'); ?>
		<?php echo $form->textField($model,'umkm_alias'); ?>
		<?php echo $form->error($model,'umkm_alias',array('class'=>'cerror')); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'umkm_deskripsi'); ?>
		<?php echo $form->textArea($model,'umkm_deskripsi'); ?>
		<?php echo $form->error($model,'umkm_deskripsi',array('class'=>'cerror')); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'umkm_telp'); ?>
		<?php echo $form->textField($model,'umkm_telp'); ?>
		<?php echo $form->error($model,'umkm_telp',array('class'=>'cerror')); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'umkm_pemilik'); ?>
		<?php echo $form->textField($model,'umkm_pemilik'); ?>
		<?php echo $form->error($model,'umkm_pemilik',array('class'=>'cerror')); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'umkm_pemilik_idcard'); ?>
		<?php echo $form->textField($model,'umkm_pemilik_idcard'); ?>
		<?php echo $form->error($model,'umkm_pemilik_idcard',array('class'=>'cerror')); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'umkm_imgurl'); ?>
		<img style="width: 100px; height: 100px" class="img-circle img-polaroid" src="<?php print ($model->umkm_imgurl != null)? Yii::app()->baseUrl.'/data/avatar/'.$model->umkm_imgurl : Yii::app()->baseUrl.'/public/empty.png' ?>">
		<?php echo $form->fileField($model,'umkm_imgurl',array('class'=>'btn btn-warning btn-small')); ?>
		<?php echo $form->error($model,'umkm_imgurl',array('class'=>'cerror')); ?>
	</div>

</div>
<div class="span3">
	

	<div class="row">
		<?php echo $form->labelEx($model,'provinsi'); ?>
		<?php echo $form->dropDownList($model,'provinsi',$listProvinsi,array('class'=>'span3',
			'ajax'=> array(
				'type'=>'POST',
				'url'=>	CController::createUrl('site/updatekota'),
				'update'=>'#Umkm_kabupaten'))
		); ?>
		<?php echo $form->error($model,'provinsi',array('class'=>'cerror')); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'kabupaten'); ?>
		<?php echo $form->dropDownList($model,'kabupaten',$listKota,array('class'=>'span3',
		'ajax'=>array(
		'type'=>'POST',
		'url'=>CController::createUrl('site/updatekecamatan'),
		'update'=>'#Umkm_kecamatan'))); ?>
		<?php echo $form->error($model,'kabupaten', array('class'=>'cerror')); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'kecamatan'); ?>
		<?php echo $form->dropDownList($model,'kecamatan',$listKecamatan,array('class'=>'span3',
		'ajax'=>array(
		'type'=>'Post',
		'url'=>CController::createUrl('site/updatedesa'),
		'update'=>'#Umkm_desa'))); ?>
		<?php echo $form->error($model,'kecamatan', array('class'=>'cerror')); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'desa'); ?>
		<?php echo $form->dropDownList($model,'desa',$listDesa,array('class'=>'span3')); ?>
		<?php echo $form->error($model,'desa', array('class'=>'cerror')); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'umkm_alamat'); ?>
		<?php echo $form->textArea($model,'umkm_alamat'); ?>
		<?php echo $form->error($model,'umkm_alamat',array('class'=>'cerror')); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Simpan',array('class'=>'btn btn-primary')); ?>
		<a href="<?php echo $this->createUrl('controlpanel/index');?>" class="btn">Kembali</a>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->