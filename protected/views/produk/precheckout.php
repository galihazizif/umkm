	<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
	<h4 id="myModalLabel">Keranjang</h4>
	<?php if(count($model) > 0):?>
	<p>
		Klik <button class="btn btn-mini btn-primary disabled" type="button"><i class="icon-hand-right icon-white"></i> Lanjut</button> dibawah ini untuk melanjutkan proses pemesanan.
	</p>
<?php endif; ?>
<?php if(count($model) <= 0):?>
	<p>Tidak ada produk didalam keranjang</p>
<?php endif; ?>
</div>

<?php if(count($model) > 0):?>
	<div class="modal-body">
		<table class="table table-condensed table-striped">
			<tr>
				<th>No.</th>
				<th>UMKM</th>
				<th>Qty</th>
				<th>...</th>
			</tr>
			<?php $i = 1; ?>
			<?php foreach($model as $data): ?>
			<tr>
				<td><?php print $i;?></td>
				<td><?php print $data['umkm_nama'];?></td>
				<td><?php print $data['qty'];?>  Produk</td>
				<td>
						<button title="Klik tombol ini untuk melanjutkan pemesanan produk <?php print $data['umkm_nama']; ?>" class="btn btn-mini btn-primary" onClick="oAjaxLink(this)" u-url="<?php print $this->createUrl('produk/checkout',array('id'=>$data['umkm_id']));?>" type="button"><i class="icon-hand-right icon-white"></i> Lanjut</button>
						<button title="Hapus seluruh keranjang produk <?php print $data['umkm_nama']; ?>" class="btn btn-mini" onClick="oAjaxLink(this)" u-url="<?php print $this->createUrl('produk/removefromcart',array('id'=>$data['umkm_id']));?>" type="button"><i class="icon-remove"></i> Hapus</button>
					</td>
				</tr>
				<?php $i++; ?>
			<?php endforeach; ?>
		</table>
	</div>
<?php endif;?>
<div class="modal-footer">
	<button type="button" class="btn btn-danger" data-dismiss="modal" aria-hidden="true"><i class="icon-remove icon-white"></i> Keluar</button>
</div>
