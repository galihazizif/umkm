<div class="x-media well">
	<div>
		<a class="pull-right btn btn-primary" href="<?php print $this->createUrl('u/1',array('a'=>$data->umkm_alias));?>"><i class="icon-check icon-white"></i> Kunjungi</a>
		<h5><?php echo CHtml::encode($data->umkm_nama); ?></h5>
		<p><i><?php echo $data->umkm_deskripsi; ?></i></p>
		<small>
		<?php if($data->umkm_telp != ''):?>
		<i class="icon-ok-circle"></i> <?php print $data->umkm_telp;?><br>
		<?php endif;?>
		 <i class="icon-home"></i>
		<?php print ($data->umkm_alamat != '')? $data->umkm_alamat.', ' : '';?>
		<?php print $data->umkmLokasiKode->alamatLengkap(); ?>
		</small>
	</div>
</div>