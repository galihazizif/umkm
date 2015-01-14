<?php
	foreach ($model as $value) {

	}

?>

<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
	<h4 id="myModalLabel"><i class="icon-shopping-cart"></i> Pengiriman <small></small></h4>
	<p>Transaksi dengan kode <?php print $value->trans_kodetrans; ?> <span class="label label-success">Telah Dibayar</span></p>
</div>
<div class="modal-body">
	<div class="span4"  style="border-right: solid 1px #cccccc">
		<p><strong><?php print $value->trans_kodetrans;?></strong>
			<p><strong><?php print $value->transPgj->pgj_nama?></strong></p>
			<p><address class="span3"><?php print $value->transPgj->pgj_alamat.' '.$value->transPgj->pgjLokasiKode->alamatLengkap(); ?></address></p>
		</p>
	</div>
	<div class="span3">
		<form id="formtrans">
			<textarea name="Transaksi[trans_keterangan]" class="span3" style=" min-height: 100px;max-height: 150px; max-width: 100%" name="Transaksi[trans_keterangan]" placeholder="misal: nomor resi pengiriman dll"></textarea>
		</form>
		<button data-dismiss="modal" type="button" class="btn btn-block"><i class="icon-hand-left"></i> Barang Belum Dikirim</button>
		<a href="#" onclick="newXhrSubmit(this,'#formtrans')" class="btn btn-primary btn-block" u-url="<?php print $this->createUrl('controlpanel/transaksipaid',array('kodetrans'=>$value->trans_kodetrans,'do'=>'paid'));?>"><i class="icon-hand-right icon-white"></i> Kirim Pemberitahuan Pengiriman Barang</a>
	</div>
</div>