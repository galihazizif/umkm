<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
	<h4 id="myModalLabel"><i class="icon-shopping-cart"></i> Rincian Pemesanan Produk <small></small></h4>
	<p></p>
</div>
<div class="modal-body">
	<table class="table table-condensed table-striped table-bordered table-hover">
		<tr>
			<th>Nama Barang</th>
			<th>Qty</th>
			<th style="text-align: right">Harga Satuan</th>
			<th style="text-align: right">Total</th>
		</tr>
		<?php 
		$sum = 0;
		foreach($model as $value): 
			$cursum = $value->trans_qty*$value->transItem->itemProd->prod_harga;
			$sum = $sum + $cursum;
			?>
		<tr>
			<td><?php print $value->transItem->itemProd->prod_nama ;?></td>
			<td><?php print $value->trans_qty; ?></td>
			<td style="text-align: right"><?php print number_format($value->transItem->itemProd->prod_harga,0,',','.'); ?></td>
			<td style="text-align: right"><?php print number_format($cursum,0,',','.');?></td>
		</tr>
		<?php endforeach;?>
	<tr>
		<td colspan="3">Total</td>
		<td style="text-align: right"><?php print number_format($sum,0,',','.');?>*</td>
	</tr>
	<tr>
		<td colspan="3">Biaya <i>packing</i> dan pengiriman</td>
			<td style="text-align: right"><form id="biaya"><input type="text" style="text-align: right; background: green; color: white; border: none" name="transaksiDetail[biayaTambahan]" id="transaksiDetail[biayaTambahan]" value="0" placeholder="Biaya Ekspedisi &amp; Packing"></form></td>
		
	</tr>
</table>
<div class="span4"  style="border-right: solid 1px #cccccc">
<p>Dipesan oleh:
<p><strong><?php print $value->transPgj->pgj_nama?></strong></p>
<p><address class="span3"><?php print $value->transPgj->pgj_alamat.' '.$value->transPgj->pgjLokasiKode->alamatLengkap(); ?><br><strong><? echo $value->transPgj->pgj_nohp;?></strong></address></p>
</p>
</div>
<div class="span3">
	<small>Pastikan persedian produk mencukupi kebutuhan pemesan, sebuah email pemberitahuan yang berisi tagihan biaya akan dikirimkan kepada pemesan ketika anda memproses pesanan ini.</small>
	<br>
	<br>
	<button data-dismiss="modal" type="button" class="btn"><i class="icon-hand-left"></i> Kembali</button>
	<a href="#" onclick="newXhrSubmit(this,'#biaya')" class="btn btn-primary" u-url="<?php print $this->createUrl('controlpanel/transaksidetail',array('kodetrans'=>$value->trans_kodetrans));?>"><i class="icon-hand-right icon-white"></i> Lanjut</a>
</div>
</div>