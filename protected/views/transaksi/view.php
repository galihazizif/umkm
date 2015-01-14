<?php
/* @var $this TransaksiController */
/* @var $model Transaksi */

$this->breadcrumbs=array(
	'Transaksis'=>array('index')
);

$htotal = 0;

$this->menu=array(
	array('label'=>'<i class="icon-th-large"></i> Kelola', 'url'=>array('admin')),
);
?>

<h4>Rincian Transaksi <?php echo $model[0]->trans_kodetrans;?></h4>
<table class="table table-condensed table-bordered">
	<tr>
		<td>Pemesan</td>
		<td><?php echo $model[0]->transPgj->pgj_nama;?></td>
	</tr>
	<tr>
		<td>UMKM</td>
		<td><?php echo $model[0]->transItem->itemProd->prodUmkm->umkm_nama;?></td>
	</tr>
	<tr>
		<td>Waktu</td>
		<td><?php echo date_format(date_create($model[0]->trans_tanggal),"d M Y / H:i:s");?></td>
	</tr>
	<tr>
		<td>Status</td>
		<td><?php echo $model[0]->getStatusLabel();?></td>
	</tr>
	<tr>
		<td>Keterangan</td>
		<td><?php echo $model[0]->trans_keterangan;?></td>
	</tr>

</table>

<table class="table table-condensed table-striped table-bordered">
	<tr>
		<th>Nama Produk</th>
		<th>Harga Satuan</th>
		<th>Qty</th>
		<th>Harga</th>

	</tr>
<?php foreach ($model as $row):
	$qty = $row->trans_qty;
	$hsatuan = $row->transItem->itemProd->prod_harga;
	$rowsum = $qty * $hsatuan;
	$htotal += $rowsum;
?>
	<tr>
		<td><?php echo $row->transItem->itemProd->prod_nama;?></td>
		<td><?php echo $row->transItem->itemProd->prod_harga.' / '.$row->transItem->itemProd->prod_satuan;?></td>
		<td><?php echo $row->trans_qty;?></td>
		<td style="text-align: right"><?php echo number_format($rowsum,0,'','.');?>
		
	</tr>
<?php endforeach;?>
	<tr>
		<td colspan="3">Biaya Tambahan</td>
		<td style="text-align: right"><?php echo number_format($row->trans_biayatambahan,0,'','.');?></td>
	</tr>
	<tr>
		<td colspan="3">Harga Total</td>
		<td style="text-align: right"><?php echo number_format($htotal+$row->trans_biayatambahan,0,'','.');?></td>
	</tr>
</table>