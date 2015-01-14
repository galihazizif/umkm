 <div id="instantreg">
	<form name="RegisterUmkmForm" id="instantregform" method="post" action="<?php echo $this->createUrl('site/registerumkm');?>">
		<h4>Daftarkan Usaha anda Sekarang...</h4>
		<input type="text" name="RegisterUmkmForm[umkm_nama]" placeholder="Nama Usaha">
		<textarea placeholder="Deskripsi Singkat" name="RegisterUmkmForm[umkm_deskripsi]"></textarea>
		<input style type="text" name="RegisterUmkmForm[umkm_email]" placeholder="Email">
		<input class="btn btn-warning btn-large" type="submit" value="Daftar !">
	</form>
</div>
