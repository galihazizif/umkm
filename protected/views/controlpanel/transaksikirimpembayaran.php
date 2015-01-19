<?php
	$this->breadcrumbs=array(
	'Konfirmasi'=>array('index'),
);
?>
	<h4 id="myModalLabel"><i class="icon-shopping-cart"></i> Konfirmasi Pembayaran <small></small></h4>
	<hr>
<div class="row">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'konfirmasi-pembayaran-konfirmasipembayaran-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// See class documentation of CActiveForm for details on this,
	// you need to use the performAjaxValidation()-method described there.
	'enableAjaxValidation'=>false,
)); ?>
<div class="span7">
	<?php echo $form->labelEx($model,'kodetransaksi'); ?>
	<?php echo $form->textField($model,'kodetransaksi',array('readonly'=>'readonly')); ?>
	<?php echo $form->error($model,'kodetransaksi',array('class'=>'cerror')); ?>
	<?php echo $form->labelEx($model,'rekeningtujuan'); ?>
	<?php echo $form->dropDownList($model,'rekeningtujuan',$daftarRekening,array('class'=>'span7')); ?>
	<?php echo $form->error($model,'rekeningtujuan',array('class'=>'cerror')); ?>
	<label class="label label-warning">Rincian Pengirim</label>
	
		<?php echo $form->labelEx($model,'nominal'); ?>
		<?php echo $form->textField($model,'nominal',array('class'=>'span2')); ?>
		<?php echo $form->error($model,'nominal',array('class'=>'cerror')); ?>

		<?php echo $form->labelEx($model,'rekeningasal'); ?>
		<?php echo $form->textField($model,'rekeningasal'); ?>
		<?php echo $form->error($model,'rekeningasal',array('class'=>'cerror')); ?>
	
		<?php echo $form->labelEx($model,'pemilikrekening'); ?>
		<?php echo $form->textField($model,'pemilikrekening'); ?>
		<?php echo $form->error($model,'pemilikrekening',array('class'=>'cerror'),array('class'=>'cerror')); ?>
	
	<label for="tanggal">Tanggal</label>	
	<?php
	$this->widget('zii.widgets.jui.CJuiDatePicker',array(
    'name'=>'KonfirmasiPembayaran[tanggal]',
    'options'=>array(
        'showAnim'=>'fade',
        'dateFormat'=>'dd/mm/yy',
    ),
    'htmlOptions'=>array(
        'placeholder'=>'Tanggal Transfer',
        'class'=>'span2',
    ),
));
?>
<?php echo $form->error($model,'tanggal',array('class'=>'cerror'),array('class'=>'cerror')); ?>
	<br>
	<a class="btn btn-warning" href="<?php echo $this->createUrl('controlpanel/vtransaksi');?>" type="button">Kembali</a>
	<button class="btn btn-primary" type="submit">Konfirmasi</button>
	</div>
<?php $this->endWidget(); ?>
</div>