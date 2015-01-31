<div class="x-media well">
	<div>
		<a class="pull-right btn btn-primary" href="<?php print $this->createUrl('u/1',array('a'=>$data->umkm_alias));?>"><i class="icon-check icon-white"></i> Kunjungi</a>
		<img style="width: 100px; height: 100px; margin-right: 5px" class="img-circle img-polaroid pull-left media-object" src="<?php print ($data->umkm_imgurl != null)? Yii::app()->baseUrl.'/data/avatar/'.$data->umkm_imgurl : Yii::app()->baseUrl.'/public/empty.png' ?>">
		<div class="media-body">
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
</div>