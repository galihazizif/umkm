<?php
/* @var $this AtributController */
/* @var $model Atribut */
/* @var $form CActiveForm */
?>

<div class="span4">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'atribut-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="span3">
		Nama Bank
		<?php echo $form->dropDownList($model,'at_kategori_id',$daftarBank); ?>
		<?php echo $form->error($model,'at_kategori_id'); ?>
	</div>

	<div class="span3">
		Rekening
		<?php echo $form->textField($model,'at_text',array('size'=>45,'maxlength'=>45,'placeholder'=>'misal: 012345678 a/n Gatotkaca')); ?>
		<?php echo $form->error($model,'at_text'); ?>
	</div>

	<div class="span5">
		<button class="btn btn-primary" type="button" u-url="<?php echo $this->createUrl($this->route);?>" onClick="newXhrSubmit(this,'#atribut-form')">Simpan</button>
	</div>
	<div class="span5">&nbsp;</div>
<?php $this->endWidget(); ?>
<br>
</div><!-- form -->
