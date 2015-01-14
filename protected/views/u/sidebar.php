<div class="span3 offset1">
<div class="span3 well well companybox" href="<?php print $this->createUrl('u/1',array('a'=>$umkm->umkm_alias));?>">
		<img style="width: 100px; height: 100px; margin: 0px 10px 10px 0px" class="img-circle img-polaroid pull-left" src="<?php echo ($umkm->umkm_imgurl != '')? Yii::app()->baseUrl.'/data/avatar/'.$umkm->umkm_imgurl : Yii::app()->baseUrl.'/public/empty.png'; ?>">	
		<h4><?php print $umkm->umkm_nama; ?></h4>
		<p><?php print $umkm->umkm_deskripsi; ?></p>
		<hr style="border: 0px transparent solid">
		<small style="clear: right"><strong for="alamat"><i class="icon-home"></i> Alamat:</strong></small>
		<p id="alamat"> <?php print ($umkm->umkm_alamat != null)? $umkm->umkm_alamat.', ': ''; print $umkm->umkmLokasiKode->alamatLengkap(); ?></p>
		<?php if($umkm->umkm_telp != null):?>
		<small><strong for="alamat">Telepon:</strong></small>
		<p id="alamat"> <?php print $umkm->umkm_telp; ?></p>
		<?php endif; ?>
		<span class="label <?php print ($umkm->umkm_status == Umkm::STATUS_VERIFIED)? 'label-success': 'label-warning';?>"><?php print $umkm->getStatusLabel();?></span>
</div>

<?php


if(count($this->halaman) > 0){
	foreach ($this->halaman as $m) {
		$data[] = array(
			'label'=>'<i class="icon-tasks"></i> '.$m->p_judul,
			'url'=>array(
				'/u/pages','a'=>$umkm->umkm_alias,'p'=>$m->p_alias));
	}
}else{
	$data = array();
}

$menu = array(
	array('label'=>'<i class="icon-home"></i> '.$umkm->umkm_nama, 'url'=>array('/u/1','a'=>$umkm->umkm_alias)),
	);

$menu = array_merge($menu,$data);

echo "<div class='well span3'>";
	$this->widget('zii.widgets.CMenu',array(
			'items'=>$menu,
			'encodeLabel'=>false,
			'htmlOptions' => array('class'=>'nav nav-list'),
		)); 
		echo "</div>";
?>

</div>