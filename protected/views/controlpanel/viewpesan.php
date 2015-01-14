<?php
/* @var $this ControlpanelController */

$this->breadcrumbs=array(
	'Pesan',
);
$this->pageTitle = Yii::app()->name.' - Pesan';
?>
<h4>Pesan dari

	<?php if($model->pes_pengirimtipe == LevelLookup::ACCOUNT_UMKM):?>
	<?php echo $model->pesPengirimUmkm->admin_email.' <small class="label label-info">'.LevelLookup::getAccountLabel($model->pes_pengirimtipe).'</small>' ?>	

	<?php elseif($model->pes_pengirimtipe == LevelLookup::ACCOUNT_SYSADMIN):?>
		<?php echo $model->pesPengirimSysAdmin->sys_email.' <small class="label label-info">'.LevelLookup::getAccountLabel($model->pes_pengirimtipe).'</small>' ?>	

	<?php elseif($model->pes_pengirimtipe == LevelLookup::ACCOUNT_VISITOR):?>
		<?php echo $model->pesPengirimPengunjung->pgj_email.' <small class="label label-info">'.LevelLookup::getAccountLabel($model->pes_pengirimtipe).'</small>' ?>	
	<?php elseif($model->pes_pengirimtipe == 0):?>
		Tamu
	<?php endif; ?>


</h4>
<div class="row">
	<div class="span7 well">
		<h5><small><?php echo date_format(date_create($model->pes_tanggal),'D, d M Y H:i:s');?></small></h5>
		<p><strong><?php echo $model->pes_judul; ?></strong></p>
		<p id="isi"><?php echo $model->pes_isi; ?></p>
	</div>
	<div class="span7 well">
		<?php if($model->pes_pengirimtipe != 0):?>
		<form action="<?php echo $this->createUrl('controlpanel/balaspesan',array('idpesan'=>$model->pes_id));?>" method="POST">
		<label for="pesan">Pesan Balasan</label>			
				<input type="text" name="Pesan[pes_judul]" placeholder="Judul" value="Balas: <?php echo substr($model->pes_judul,0,25);?>"><br>
				<?php echo ($balasan->hasErrors())? '<br><span class="cerror">'.$balasan->getError('pes_judul').'</span>': ''?>
				<textarea style="max-width: 400px; min-width: 400px; min-height: 150px" id="pesan" name="Pesan[pes_isi]" placeholder="Isi Balasan"></textarea>
				<?php echo ($balasan->hasErrors())? '<br><span class="cerror">'.$balasan->getError('pes_isi').'</span>': ''?>
				<br>
				<input type="submit" class="btn btn-primary" value="Balas">
				<a href="<?php echo $this->createUrl('controlpanel/cekpesan');?>" class="btn btn-warning">Kembali</a>
		</form>
		<?php endif; ?>
	</div>
</div>