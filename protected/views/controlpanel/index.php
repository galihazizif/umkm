<?php
/* @var $this ControlpanelController */

$this->breadcrumbs=array(
	'Pengaturan Akun',
);
$this->pageTitle = Yii::app()->name.' - Pengaturan';
?>
<h4>Rincian Akun <a class="btn btn-mini" href="<?php echo $this->createUrl('controlpanel/editumkm');?>" title="Sunting"><i class="icon-edit"></i></a></h4>
<div class="row">
	<div class="span4">
		<table class="table table-condensed">
			<tr>
				<td colspan="2">
					<img style="width: 100px; height: 100px;" class="img-circle img-polaroid" src="<?php print ($model->adminUmkm->umkm_imgurl != null)? Yii::app()->baseUrl.'/data/avatar/'.$model->adminUmkm->umkm_imgurl : Yii::app()->baseUrl.'/public/empty.png' ?>">
				</td>
				<td style="padding-left: 10px; vertical-align: middle; text-align: center">
					<h4><?php print $model->adminUmkm->umkm_nama; ?></h4>
				</td>
			</tr>
			<tr>
				<td>Deskripsi</td>
				<td>:</td>
				<td><?php print $model->adminUmkm->umkm_deskripsi; ?></td>
			</tr>
			<tr>
				<td>Alias</td>
				<td>:</td>
				<td><?php print $model->adminUmkm->umkm_alias; ?></td>
			</tr>
			<tr>
				<td>Administrator</td>
				<td>:</td>
				<td><?php print $model->adminUmkm->umkm_email; ?></td>
			</tr>
			<tr>
				<td>Telepon Utama</td>
				<td>:</td>
				<td><?php print $model->adminUmkm->umkm_telp; ?></td>
			</tr>
			<tr>
				<td>Alamat</td>
				<td>:</td>
				<td><?php echo ($model->adminUmkm->umkm_alamat != '')? $model->adminUmkm->umkm_alamat.'<br>': '', ucwords(strtolower($model->adminUmkm->umkmLokasiKode->alamatLengkap())) ?></td>
			</tr>
		</table>
	</div>
	<div class="span4">
		<table class="table table-condensed">
			
			<tr>
				<td>Email/Username</td>
				<td>:</td>
				<td><?php print $model->admin_email; ?></td>
			</tr>
			<tr>
				<td>Tanggal Registrasi</td>
				<td>:</td>
				<td><?php print date_format(date_create($model->admin_regdate),'d M Y / H:i:s') ?></td>
			</tr>
			<tr>
				<td colspan="3">
					<?php print CHtml::ajaxLink('Ubah Password',
					array('controlpanel/updateumkmpassword'),
					array(
						'beforeSend'=>'function(){loadingIcon("#myModal");$("#myModal").modal();}',
						'success'=>'function(data){$("#myModal").html(data)}',
						),
					array('class'=>'btn'));?>
				</td>
			</tr>
		</table>
	</div>
	<div class="row span5">
		<div class="row span5">
		<ul class="nav nav-tabs" id="myTab">
		<?php if(Yii::app()->user->isUmkmOwner()):?>
		  <li class="active"><a data-toggle="tab" href="#home">Pengelola UMKM</a></li>
		<?php endif;?>
		  <li><a data-toggle="tab" href="#profile">Profile</a></li>
		  <li><a data-toggle="tab" href="#messages">Messages</a></li>
		  <li><a data-toggle="tab" href="#settings">Settings</a></li>
		</ul>
 
		<div class="tab-content">
		<?php if(Yii::app()->user->isUmkmOwner()):?>
		  <div class="tab-pane active" id="home">
		  	<table class="table table-condensed">
		  		<tr><th>Email</th><th>...</th></tr>
		  	<?php foreach($model->adminUmkm->admins as $admin):?>
		  		<tr><td><?php print $admin->admin_email; ?></td><td>
		  			<?php if($admin->admin_isowner != 1) print CHtml::link('x',array('site/xdeleteumkmemail','id'=>$admin->admin_id),array('class'=>'btn btn-mini','confirm'=>'Hapus?'));?>

		  		</td></tr>
		  	<?php endforeach; ?>
		  	</table>
			<?php print CHtml::ajaxLink('Tambah Akun',
			array('site/xaddumkmemail'),
			array(
				'beforeSend'=>'function(){loadingIcon(\'#myModal\');$("#myModal").modal();}',
				'success'=>'js:function(data){$("#myModal").html(data);}'),
			array('class' =>'btn btn-primary'));?>
		  </div>
		  <br>
		<?php endif;?>
		  <div class="tab-pane" id="profile">profile</div>
		  <div class="tab-pane" id="messages">Messages</div>
		  <div class="tab-pane" id="settings">Settting</div>
		</div>
 
		<script>
		  $(function () {
		    $('#myTab a:first').tab('show');
		  })
		</script>
	</div>	
	</div>

</div>