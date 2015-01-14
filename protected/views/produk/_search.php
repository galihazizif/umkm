<?php
/* @var $this ProdukController */
/* @var $model Produk */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
	'htmlOptions'=>array('class'=>'form-inline'),
)); ?>

	<div class="row">
		<?php echo $form->textField($model,'prod_nama',array('size'=>45,'maxlength'=>45,'placeholder'=>'Cari produk')); ?>
		<?php echo CHtml::submitButton('Cari',array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->