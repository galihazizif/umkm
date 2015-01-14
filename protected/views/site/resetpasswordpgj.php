<?php $this->pageTitle = Yii::app()->name." - Reset Password"; ?>

<div class="row" style="margin-top: 125px;">

	<div class="offset4 span4">
		<p class="row">Masukkan email anda untuk mereset password. Sebuah link akan dikirimkan ke email anda.</p>


		<?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'umkm-reset',
			'enableAjaxValidation'=>false,
			'clientOptions'=>array(
				'validateOnSubmit'=>true)
)); ?>
		<div class="row">
			<div class="input-prepend">
				<span class="add-on"><i class="icon-envelope"></i></span>
				<?php print $form->textField($model,'email',array('class'=>'input-xlarge','placeholder'=>'Masukan Email anda disini'))?>
				<?php print $form->error($model,'email',array('class'=>'cerror'))?>
			</div>
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
				<input style="margin: 5px auto 0 auto" type="submit" class="btn btn-primary" value="Kirim">
		<?php $this->endWidget();?>
	</div>
</div>