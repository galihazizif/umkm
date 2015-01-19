<div class="row">
	<div class="offset1 span4">
		<form method="GET" action="<?php print $this->createUrl('u/search',array('a'=>$umkm->umkm_alias));?>">
			<div class="input-append">
				<input name="q" class="span4" placeholder="Temukan produk di <?php echo $umkm->umkm_nama;?>" id="appendedInputButtons" value="<?php echo isset($_GET['q'])? $_GET['q']: '';?>" type="text">
				<button type="button" onclick="submit();" class="btn btn-warning"><i class="icon-search icon-white"></i> Cari</button>
			</div>
		</form>
	</div>
	<!-- <div class="span4">
		<ul class="navbar">
			<li><a href="#">A</a></li>
			<li><a href="#">B</a></li>
			<li><a href="#">C</a></li>
		</ul>
	</div> -->
</div>