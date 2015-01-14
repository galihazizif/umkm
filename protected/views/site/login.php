<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);
?>

<div class="row">
		<div class="undernavbar"><span class="undernavbar-inner">Daftarkan usaha atau produk Anda Sekarang <a class="btn btn-danger"  href="<?php print Yii::app()->createUrl('site/registerumkm');?>">Daftar</a></div>
</div>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>true,
	'enableAjaxValidation'=>false,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<div class="row">
		<div class="offset1 span3" id="loginform">
			<div style="background: white; float: left; width: 100%; margin-bottom: 10px">
				<p style="padding: 10px 10px 0px 30px"><strong><u>Login</u></strong><br><small>Gunakan alamat email anda sebagai <code>username</code> untuk login</small></p>	
			</div>
	
	
			<div class="row">
				<div class="input-prepend span3" style="padding-left: 7%"><span class="add-on"><i class="icon-user"></i></span>
					<?php echo $form->textField($model,'username', array('placeholder' => 'E-Mail / Username', )); ?>
				</div>
				<?php echo $form->error($model,'username',array('class'=>'cerror span3','style'=>'padding-left: 7%')); ?>
			</div>

			<div class="row">
				<div class="input-prepend span3" style="padding-left: 7%"><span class="add-on"><i class="icon-lock"></i></span>
					<?php echo $form->passwordField($model,'password',array('placeholder'=>'Password')); ?>
				</div>
				<?php echo $form->error($model,'password',array('class'=>'cerror span3','style'=>'padding-left: 7%')); ?>
			</div>

			<div class="row">
				<label class="span3" style="padding-left: 7%"><small>Tipe Akun</small></label>
				<div class="input-prepend span3" style="padding-left: 7%"><span class="add-on"><i class="icon-plus-sign"></i></span>
				<?php echo $form->dropDownList($model,'tipe',array(
					'1'=>'UMKM',
					'2'=>'Admin',
					'3'=>'Pengunjung',
				)); ?>
				</div>
			</div>
			<?php echo $form->error($model,'tipe',array('class'=>'cerror','style'=>'padding-left: 7%')); ?>

				<div class="span3">
					<label class="checkbox">
						<strong>Simpan sesi login.</strong>
						<?php echo $form->checkBox($model,'rememberMe'); ?>
					</label>		
				</div>
			

				<div class="row">
					<div class="span3">
						<?php echo CHtml::submitButton('Login',array('class'=>'btn btn-primary','style'=>'margin: auto auto auto 7%; margin-bottom: 10%')); ?>
					</div>			
				</div>
				<div class="row">
					<div class="dropdown btn-group" style="margin-left: 40px">
						<button type="button" data-toggle="dropdown" class="btn btn-link"> Lupa password?</button>
						<ul class="dropdown-menu" style="border-radius: 0 0 0 0; padding: 0">
							<li><a href="<?php echo $this->createUrl('site/resetpasswordpgj');?>">Pengunjung</a></li>
							<li><a href="<?php echo $this->createUrl('site/resetpasswordumkm');?>">UMKM</a></li>
						</ul>
					</div>
				</div>	
			</div>	

<?php $this->endWidget(); ?>

	<div class="span7" style="height: 500px">
		
		<h3>Daftarkan Usaha anda sekarang, dapatkan beberapa keuntungan.</h3>

		<div class="media">
			<img class="media-object pull-left" src="<? print Yii::app()->request->baseUrl; ?>/public/assets/img/png/text44.png">
			<div class="media-body">
				<h4 class="media-heading">Mudahkan orang menemukan usaha anda di internet</h4>
				<p>Tingkatkan peluang penjualan produk maupun kerjasama dengan pihak lain.</p>
			</div>
		</div>

		<div class="media">
			<img class="media-object pull-left" src="<? print Yii::app()->request->baseUrl; ?>/public/assets/img/png/little27.png">
			<div class="media-body">
				<h4 class="media-heading">Ciptakan Banyumas yang lebih sejahtera</h4>
				<p>Mari dukung pemerintah dalam menumbuhkan dan memperkuat UMKM di wilayah Banyumas dan sekitarnya.</p>
			</div>
		</div>

		<div class="media">
			<img class="media-object pull-left" src="<? print Yii::app()->request->baseUrl; ?>/public/assets/img/png/speaker8.png">
			<div class="media-body">
				<h4 class="media-heading">Nikmati kemudahan menjual produk anda secara online *</h4>
				<p>Jual produk anda secara online, memudahkan pembeli untuk bertransaksi dari berbagai tempat.</p>
			</div>
		</div>

		<div class="media">
			<img class="media-object pull-left" src="<? print Yii::app()->request->baseUrl; ?>/public/assets/img/png/circle10.png">
			<div class="media-body">
				<h4 class="media-heading">Ubah tema halaman usaha online anda sesuai selera</h4>
				<p>Tuangkan keunikan usaha anda untuk memberi kesan khusus kepada pembeli.</p>
			</div>
		</div>		
	</div>


	</div>
	
	



