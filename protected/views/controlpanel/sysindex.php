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

?>

<div class="span8 well">
	<h5><?php echo $greet ?> <i></i></h5>
</div>

<div class="row">
<small>
<div class="span3">
<span class="span3">UMKM terbaru yang melakukan registrasi di <?php echo Yii::app()->name;?></span>
<table id="umkm" class="table table-condensed table-striped table-hover span3 table-bordered">
	<tr>
		<th>
			UMKM
		</th>
		<th>
			Registrasi
		</th>
	</tr>
	<?php foreach($umkm as $u):?>
	<tr>
		<td><?php echo $u->umkm_nama;?></td>
		<td><?php echo date_format(date_create($u->umkm_tanggal),'d M Y');?></td>
	</tr>
	<?php endforeach;?>
</table>
</div>

<div class="span4">
<span class="span4">Daftar Produk terbaru</span>
<table id="umkm" class="table table-condensed table-striped table-hover span4 table-bordered">
	<tr>
		<th>
			Produk
		</th>
		<th>
			UMKM
		</th>
	</tr>
	<?php foreach($produk as $p):?>
	<tr>
		<td><?php echo $p->prod_nama;?></td>
		<td><?php echo $p->prodUmkm->umkm_nama;?></td>
	</tr>
	<?php endforeach;?>
</table>
</div>

<div class="span4">
<span class="span4">Transaksi terbaru UMKM</span>
<table id="umkm" class="table table-condensed table-striped table-hover span4 table-bordered">
	<tr>
		<th>
			Produk
		</th>
		<th>
			Tanggal
		</th>
	</tr>
	<?php foreach($transaksi as $t):?>
	<t>
		<td><?php echo $t->transItem->itemProd->prod_nama;?></td>
		<td><?php echo date_format(date_create($t->trans_tanggal),'d M Y');?></td>
	</tr>
	<?php endforeach;?>
</table>
</div>

</small>
</div>