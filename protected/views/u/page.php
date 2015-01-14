<?php

$this->pageTitle = $umkm->umkm_nama.' - Pencarian';

/*This is required for applying custom user interface for every umkm user*/

?>

<div class="row">&nbsp;</div>
<?php $this->renderPartial('/u/_uSearchInput',array('umkm'=>$umkm));?>
<div class="row">
	<?php $this->renderPartial('/u/sidebar',array('umkm'=>$umkm));?>
	<div class="offset1 span7 well well-small">
		<h4><?php echo $model->p_judul; ?></h4>
		<?php echo $model->p_isi;?>



	</div>
</div>