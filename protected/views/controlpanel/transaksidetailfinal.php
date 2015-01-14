<?php foreach ($model as $v) {
	# code...
}?>
<html>
<head>
	<style type="text/css">
		.table{
			background: #cccccc;
			width: 100%;
			border: solid 1px black;
		}
	</style>
</head>
<body>
<h4>Invoice <?php print $v->trans_kodetrans; ?></h4>
<p>Yth. <b><?php print $v->transPgj->pgj_nama; ?></b>,<br>
Anda menerima email ini karena telah memesan produk pada <?php print $v->transItem->itemProd->prodUmkm->umkm_nama;?></p>
<p>Pesanan ini dilakukan pada <?php print date_format(date_create($v->trans_tanggal),'d-m-Y H:i:s').' WIB';?> menggunakan alamat email ini.</p>
<table class="table">
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
	<tr style="background: gray">
		<td colspan="3">Biaya Packing dan Pengiriman</td>
		<td style="text-align: right"><?php print number_format($biaya,0,',','.');?>*</td>
	</tr>
	<tr>
		<td colspan="3">Total</td>
		<td style="text-align: right"><?php print number_format($sum+$biaya,0,',','.');?>*</td>
	</tr>
</table>
<p>Pesanan akan dikirimkan kepada:</p>
<p><b><?php print $value->transPgj->pgj_nama;?></b><br>
	<?php print $value->transPgj->pgj_alamat.' '.$value->transPgj->pgjLokasiKode->alamatLengkap(); ?><br><strong><? echo $value->transPgj->pgj_nohp;?></strong>
</p>
</body>