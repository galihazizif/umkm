<div class="navbar-form pull-right">
	<div class="btn-group dropdown">
		<?php if(Yii::app()->user->isGuest):?>
		<button type="button" data-toggle="dropdown" class="btn btn btn-small"><i class="icon-lock"></i> Login</button>
		<ul class="dropdown-menu" style="border-radius: 0 0 0 0; padding: 0">
			<li><a onClick="oAjaxLink(this,true); return false;" u-url="<?php print $this->createUrl('site/xlogin',array('tab'=>'visitor'));?>" href="#">Pengunjung</a></li>
			<li><a onClick="oAjaxLink(this,true); return false;" u-url="<?php print $this->createUrl('site/xlogin',array('tab'=>'umkm'));?>" href="#">UMKM</a></li>
		</ul>
	<?php endif;?>
	<?php if(!Yii::app()->user->isGuest):?>
	<button type="button" data-toggle="dropdown" class="btn btn-small btn"><i class="icon-user"></i> <?php print Yii::app()->user->name;?> 
		<span title="Pesan yang belum dibaca" id="msg-notif" class="badge badge-important"><?php $notif = $this->beginWidget('CekPesan'); echo $notif->cekPesan(); $this->endWidget();?></span>

	</button>
	<ul class="dropdown-menu" style="border-radius: 0 0 0 0; padding: 0">
		<div class="summary-box"><small>Anda login sebagai :<br><span class="label"><?php print LevelLookup::getAccountLabel(Yii::app()->user->getTipe());?></span></small></div>
		<li><a href="<?php print $this->createUrl('controlpanel/cekpesan');?>"><i class="icon-envelope"></i> Pesan</a></li>
		<li><a href="<?php print $this->createUrl('controlpanel/index');?>"><i class="icon-wrench"></i> Control Panel</a></li>
		<li><a href="<?php print $this->createUrl('site/logout');?>"><i class="icon-off"></i> Keluar</a></li>
	</ul>
<?php endif;?>

<?php
if(Yii::app()->user->isGuest || Yii::app()->user->isPengunjung()){
	$cart = new umkmCart;
	$cart->showButton();
}
else{
	print "<a class='btn btn-small' href='".$this->createUrl('site/logout')."'><i class='icon-off'></i></a>";
}
?>

</div>
</div>