<?php $this->pageTitle = Yii::app()->name." - Atur ulang kata sandi akun anda"; ?>

<div class="row" style="margin-top: 125px;">

	<div class="offset4 span4">
		<p class="row">Masukkan password baru anda.</p>


		<?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'umkm-reset',
			'enableAjaxValidation'=>false,
			'clientOptions'=>array(
				'validateOnSubmit'=>true)
		)); ?>
		<div class="row">
			<div class="input-prepend">
				<span class="add-on"><i class="icon-lock"></i></span>
				<?php print $form->passwordField($passModel,'password',array('class'=>'input-xlarge','placeholder'=>'Masukan password baru anda'))?>
				<?php print $form->error($passModel,'password',array('class'=>'cerror'))?>
			</div>
		</div>
		<div class="row">
			<div class="input-prepend">
				<span class="add-on"><i class="icon-pencil"></i></span>
				<?php print $form->passwordField($passModel,'conf_password',array('class'=>'input-xlarge','placeholder'=>'Ketik ulang password anda disini'))?>
				<?php print $form->error($passModel,'conf_password',array('class'=>'cerror'))?>
			</div>
		</div>
		<div class="row">
			<input style="" type="submit" class="btn btn-primary" value="Simpan">
		</div>
		<?php $this->endWidget();?>
	</div>
</div>