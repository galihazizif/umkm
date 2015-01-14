<?php
/* @var $this ProdukController */
/* @var $model Produk */
/* @var $form CActiveForm */
?>

<div class="span6">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'produk-form',
	'htmlOptions'=>array('enctype'=>'multipart/form-data'),
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'prod_nama'); ?>
		<?php echo $form->textField($model,'prod_nama',array('size'=>45,'maxlength'=>47)); ?>
		<?php echo $form->error($model,'prod_nama',array('class'=>'cerror')); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'prod_deskripsi'); ?>
		<?php echo $form->textArea($model,'prod_deskripsi',array('style'=>'min-width: 350px; maxwidth: 350px; min-height: 70px')); ?>
		<?php echo $form->error($model,'prod_deskripsi',array('class'=>'cerror')); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'prod_kat_id'); ?>
		<?php echo $form->dropDownList($model,'prod_kat_id',$kategori)?>
		<?php echo $form->error($model,'prod_kat_id',array('class'=>'cerror')); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'prod_harga'); ?>
		<?php echo $form->textField($model,'prod_harga',array('size'=>10,'maxlength'=>10)); ?>
		<span class="label">per</span> 
		<?php echo $form->textField($model,'prod_satuan',array('style'=>'width: 100px','maxlength'=>15)); ?>
		<small>mis: 1 Kg, 10 Bungkus, 100 gram dsb.</small>
		<?php echo $form->error($model,'prod_harga',array('class'=>'cerror')); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'stok'); ?>
		<?php echo $form->textField($model,'stok',array('class'=>'span1','placeholder'=>'Qty')); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'prod_img'); ?>
		<?php echo $form->fileField($model,'prod_img',array('class'=>'uploadarea btn btn-danger','placeholder'=>'Gambar')); ?>
		<?php echo $form->error($model,'prod_img',array('class'=>'cerror')); ?>
	</div>
	<br>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Simpan' : 'Simpan Perubahan',array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

<div class="span2">
	<?php if($model->prod_img != null): ?>
	<img class="img-polaroid" src="<?php print Yii::app()->baseUrl.'/data/'.$model->prod_img; ?>">
	<?php endif;?>
</div>

</div><!-- form -->