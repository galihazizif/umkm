 <div id="instantreg">
 	<h4 style="margin: 0 0 0 10px">Daftarkan Usaha anda Sekarang...</h4>
 	<a href="<?php echo $this->createUrl('site/registerumkm');?>"><img style="margin: 10px 0 10px 15px; width: 85%" src="<?php echo Yii::app()->request->baseUrl;?>/public/guide.png">
 		</a>
	<form name="RegisterUmkmForm" id="instantregform" method="post" action="<?php echo $this->createUrl('site/registerumkm');?>">
		<input type="text" name="RegisterUmkmForm[umkm_nama]" placeholder="Nama Usaha">
		<textarea placeholder="Deskripsi Singkat" name="RegisterUmkmForm[umkm_deskripsi]"></textarea>
		<input style type="text" name="RegisterUmkmForm[umkm_email]" placeholder="Email">
		<input class="btn btn-warning btn-large" type="submit" value="Daftar !">
	</form>
</div>
