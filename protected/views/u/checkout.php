<?php
/* @var $this UController */


$this->pageTitle = $umkm->umkm_nama;

/*This is required for applying custom user interface for every umkm user*/
?>
<div class="row">&nbsp;</div>
<?php $this->renderPartial('/u/_uSearchInput',array('umkm'=>$umkm));?>
<div class="row">
<?php $this->renderPartial('/u/sidebar',array('umkm'=>$umkm));?>
<div class="offset1 span7">
	<h4 id="myModalLabel">Checkout</h4>
	<p>Berikut ini produk yang akan anda pesan pada <strong><?php print $umkm->umkm_nama; ?></strong></p>
	<?php if(count($model) <= 0):?>
	<p>Tidak ada produk didalam keranjang</p>
<?php endif; ?>

<?php if(count($model) > 0):?>
	<div class="">
		<table class="table table-condensed table-striped table-bordered">
			<tr>
				<th></th>
				<th>Produk</th>
				<th title="Jumlah barang">Qty</th>
				<th title="Harga Satuan">Harga Satuan</th>
				<th>Harga</th>
				
			</tr>
			<?php $i = 1; 
				  $isThereAnyOverBook = false;

			?>
			<?php foreach($model as $data): ?>
			<?php $color = ($data['sisa'] < 0)? 'error': ''; ?>
			<?php if($data['sisa'] < 0){
				$color = 'error';
				$isThereAnyOverBook = true;
			}
			else
				$color = '';

			?>
			<tr class="<?php print $color; ?>">
				<td>
					<?php print $i;?>
				</td>
				<td>
					<?php print $data['prod_nama']; ?>
				</td>
				<td>
					<?php print $data['qty']; print ($color == '')? '':' <a rel="tooltip" href="#"  title="Stok tidak cukup untuk memenuhi jumlah pesanan anda." class="badge badge-info tooltipx">Stok tidak cukup, produk tinggal '.$data['item_stok'].'</a>';?> 
				</td>
				<td>
					<?php print number_format($data['prod_harga'],0,',','.'); print ($data['prod_satuan'] != '')? ' / '.$data['prod_satuan']:''; ?>
				</td>
				<td style="text-align: right;">
					<?php print number_format($data['jumlah_harga'],0,',','.') ?>
				</td>
			</tr>
			<?php $i++; ?>
		<?php endforeach; ?>
			<tr>
				<td style="text-align: right" colspan="4">Jumlah Harga : </td>
				<td style="text-align: right"><u><strong><?php print number_format($harga_total,0,',','.');?></strong></u></td>
			</tr>
	</table>
	<?php if($isThereAnyOverBook): ?>
	<p class="alert alert-danger">
			<button type="button" class="close" style="color: white" data-dismiss="alert"><i class="icon-remove"></i></button>
		<small><strong>Perhatian! <br></strong>Terdapat sejumlah pemesanan yang melebihi persediaan barang, jika anda melanjutkan pemesanan ini proses checkout akan gagal.<a href="#" onClick="oAjaxLink(this,true)" u-url="<?php print $this->createUrl('produk/checkout',array('id'=>$data['umkm_id']));?>"><i class="icon-hand-right"></i> Klik Disini</a> untuk mengubahnya.</small></p>
	<?php endif;?>

	<!-- A Jika yang login bukan pengunjung -->
	<?php if(!Yii::app()->user->isPengunjung()): ?>
	<p>Anda harus <a href="#" onClick="oAjaxLink(this,true);" u-url="<?php print $this->createUrl('site/xlogin',array('tab'=>'visitor'));?>">Login</a> sebagai pengunjung untuk melanjutkan pemesanan ini </p>
	<?php endif; ?>
	<!-- A - END -->

	<!-- B Jika yang login pengunjung -->
	<?php if(Yii::app()->user->isPengunjung()): ?>
	
	<p>Harga sebesar <strong>Rp. <?php print number_format($harga_total,0,',','.');?></strong> belum termasuk biaya pengiriman*. Silahakan tunggu konfirmasi yang akan dikirimkan oleh Pengelola UMKM ke email anda.</p>

	<p>Berikut ini informasi mengenai alamat pengiriman barang anda:</p>
	<div class="well well-compact">
		<address id="alamat">
		<strong><?php print $visitor->pgj_nama; ?></strong>
			<br>
		<?php print $visitor->pgj_alamat.' '.$visitor->pgjLokasiKode->alamatLengkap('<br>'); ?></address>
	</div>
	<p class="label label-important">
		<strong>Perhatian!</strong> Jangan pernah melakukan transfer sebelum mendapatkan konfirmasi dari pengelola UMKM.
	</p>
	<p><small>Dengan men-klik tombol checkout dibawah ini maka pengunjung menyetujui <a href="<?php print $this->createUrl('site/page',array('view'=>'syaratketentuan'));?>">syarat dan ketentuan</a>  yang berlaku.</small></p>
	<a id="w" href="<?php print $this->createUrl('u/finalcheckout',array('a'=>$umkm->umkm_alias));?>" class="btn btn-primary btn-block btn-large"><i class="icon-check icon-white"></i> Checkout</a>
	<br>
	<?php endif;?>
	<!-- B - END -->
</div>
<?php endif;?>


</div>
</div>





