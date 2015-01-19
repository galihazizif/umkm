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
		<td colspan="3">Biaya <i>packing</i> dan pengiriman</td>
		<td style="text-align: right"><?php print number_format($value->trans_biayatambahan,0,',','.');?></td>		
	</tr>
	<tr>
		<td colspan="3">Total</td>
		<td style="text-align: right"><?php print number_format($sum + $value->trans_biayatambahan,0,',','.');?>*</td>
	</tr>
	<tr class="info">
		<td colspan="3">Status</td>
		<td style="text-align: right"><?php print $value->getStatusLabel();?></td>
	</tr>
	<tr class="">
		<td>Keterangan</td>
		<td colspan="3"><?php print $value->trans_keterangan;?></td>
	</tr>
</table>
<div class="span4"  style="border-right: solid 1px #cccccc">
<p>Dipesan oleh:
<p><strong><?php print $value->transPgj->pgj_nama?></strong></p>
<p><address class="span3"><?php print $value->transPgj->pgj_alamat.' '.$value->transPgj->pgjLokasiKode->alamatLengkap(); ?></address></p>
</p>
</div>
<?php if(Yii::app()->user->isPengunjung() && $value->trans_status == Transaksi::STATUS_APPROVED):?>
<div class="span4">
	<a class="btn btn-primary btn-large btn-block" href="<?php echo $this->createUrl('controlpanel/transaksikirimpembayaran',array('kodetrans'=>$value->trans_kodetrans));?>">Konfirmasi Pembayaran</a>
</div>
<?php endif;?>

<?php if(Yii::app()->user->isUmkm() && $value->trans_status == Transaksi::STATUS_CHECK):?>
<div class="span3">
	<button data-dismiss="modal" type="button" class="btn"><i class="icon-hand-left"></i> Kembali</button>
	<a href="#" onclick="oAjaxLink(this)" class="btn btn-primary" u-url="<?php print $this->createUrl('controlpanel/transaksipayment',array('kodetrans'=>$value->trans_kodetrans,'do'=>'paid'));?>"><i class="icon-hand-right icon-white"></i> Terbayar</a>
</div>
<?php endif;?>

<?php if(Yii::app()->user->isUmkm() && $value->trans_status == Transaksi::STATUS_APPROVED):?>
<div class="span3">
	<button data-dismiss="modal" type="button" class="btn"><i class="icon-hand-left"></i> Kembali</button>
	<a href="#" onclick="oAjaxLink(this)" class="btn btn-primary" u-url="<?php print $this->createUrl('controlpanel/transaksipayment',array('kodetrans'=>$value->trans_kodetrans,'do'=>'paid'));?>"><i class="icon-hand-right icon-white"></i> Terbayar</a>
</div>
<?php endif;?>

<?php if(Yii::app()->user->isUmkm() && $value->trans_status == Transaksi::STATUS_PAID):?>
<div class="span3">
		<form id="formtrans">
			<textarea name="Transaksi[trans_keterangan]" class="span3" style=" min-height: 100px;max-height: 150px; max-width: 100%" name="Transaksi[trans_keterangan]" placeholder="misal: nomor resi pengiriman dll"></textarea>
		</form>
		<button data-dismiss="modal" type="button" class="btn btn-block"><i class="icon-hand-left"></i> Barang Belum Dikirim</button>
		<a href="#" onclick="newXhrSubmit(this,'#formtrans')" class="btn btn-primary btn-block" u-url="<?php print $this->createUrl('controlpanel/transaksipaid',array('kodetrans'=>$value->trans_kodetrans,'do'=>'paid'));?>"><i class="icon-hand-right icon-white"></i> Kirim Pemberitahuan Pengiriman Barang</a>
</div>
<?php endif;?>

</div>