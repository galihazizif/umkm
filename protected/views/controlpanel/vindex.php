<?php
/* @var $this ControlpanelController */

$this->breadcrumbs=array(
	'Pengaturan Akun',
);
$this->pageTitle = Yii::app()->name.' - Pengaturan Akun';

$d = date_create(date('H:i'));
if(date_create('00:00') < $d && $d < date_create('10:00'))
	$greet = 'Selamat pagi';
else if(date_create('10:00') < $d && $d < date_create('14:00'))
	$greet = 'Selamat siang';
else if(date_create('14:00') < $d && $d < date_create('17:00'))
	$greet = 'Selamat Sore';
else if(date_create('17:00') < $d && $d < date_create('19:00'))
	$greet = 'Selamat Petang';
else $greet = 'Selamat Malam';

$nick = explode(' ', $model->pgj_nama);

?>

<div class="span8 well">
	<h5><?php echo $greet ?> <i><u><?php echo $nick[0];?></u></i></h5>
	<p>Berikut ini informasi rincian akun anda <a class="btn btn-mini" href="<?php echo $this->createUrl('controlpanel/editpengunjung');?>" title="Sunting"><i class="icon-edit"></i></a></p> 
	<table class="table">
		<tr>
			<td>Nama</td>
			<td><?php echo $model->pgj_nama;?></td>
		</tr>
		<tr>
			<td>Alamat</td>
			<td><?php echo ($model->pgj_alamat != '')?$model->pgj_alamat.', ':'',$model->pgjLokasiKode->alamatLengkap('<br>');?></td>
		</tr>
		<tr>
			<td>Email</td>
			<td><?php echo $model->pgj_email;?></td>
		</tr>
		<tr>
			<td>Telepon</td>
			<td><?php echo $model->pgj_nohp;?></td>
		</tr>
		<tr>
			<td>Password</td>
			<td><button type="button" class="btn btn-mini" onclick="oAjaxLink(this,true)" u-url="<?php echo $this->createUrl('controlpanel/vupdatepassword');?>">Reset Password</button></td>
		</tr>


	</table>

</div>