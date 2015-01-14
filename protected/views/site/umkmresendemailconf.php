<?php $this->pageTitle = Yii::app()->name." - Kirim Ulang Konfirmasi"; ?>

<div class="row" style="margin-top: 125px;">

	<div class="offset4 span4">
		<p style>Kirim ulang kode verifikasi email pendaftaran UMKM, masukan alamat email yang telah didaftarkan.</p>


		<?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'umkm-resend',
			'enableAjaxValidation'=>false,
			'enableClientValidation'=>true,
			'clientOptions'=>array(
				'validateOnSubmit'=>true)
)); ?>
			
			<div class="input-prepend">
				<span class="add-on"><i class="icon-envelope"></i></span>
				<?php print $form->textField($model,'email',array('class'=>'input-xlarge','placeholder'=>'Masukan Email anda disini'))?>
				<?php print $form->error($model,'email',array('class'=>'cerror'))?>
			</div>

			<div class="row">
				<div class="span4">
					<?php $this->widget('CCaptcha',array('showRefreshButton'=>false,'clickableImage'=>true,'imageOptions'=>
					array('title'=>'Klik Untuk mengganti kode.','class'=>'img-polaroid'))); ?>
					<?php echo $form->textField($model,'verifyCode',array('class'=>'input-small','placeholder'=>'Captcha')); ?>
					<?php echo $form->error($model,'verifyCode', array('class'=>'cerror')); ?>
				</div>
			</div>
				<input style="margin: 5px auto 0 auto" type="submit" class="btn btn-primary" value="Kirim">
		<?php $this->endWidget();?>
	</div>
</div>