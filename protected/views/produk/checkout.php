<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
	<h4 id="myModalLabel">Keranjang</h4>
	<p>Produk yang akan anda pesan pada <strong><?php print $umkm->umkm_nama; ?></strong></p>
<?php if(count($model) <= 0):?>
	<p>Tidak ada produk didalam keranjang</p>
<?php endif; ?>
</div>

<?php if(count($model) > 0):?>
	<div class="modal-body">
		<table class="table table-condensed table-striped">
			<tr>
				<th></th>
				<th>Produk</th>
				<th title="Jumlah barang">Qty</th>
				<th>...</th>
			</tr>
			<?php $i = 1; ?>
			<?php foreach($model as $data): ?>
			<tr>
				<td>
					<?php print $i;?>
				</td>
				<td>
					<?php print $data['prod_nama']; ?>
				</td>
				<td>
					<?php print $data['qty']; ?>
				</td>
				<td>
					<button onClick="oAjaxLink(this)" title="Hapus produk ini dari keranjang" u-url="<?php print $this->createUrl('produk/removeitemfromcart',array('id'=>$data['krj_item_id'],'umkmid'=>$data['umkm_id']));?>" class="btn btn-mini btn-link" type="button"><i class="icon-remove"></i></button>
				</td>
			</tr>
				<?php $i++; ?>
			<?php endforeach; ?>
		</table>
	</div>
<?php endif;?>
<div class="modal-footer">
	<button class="btn" onClick="oAjaxLink(this)" u-url="<?php print $this->createUrl('produk/precheckout');?>" type="button"><i class="icon-hand-left"></i> Kembali</button>
	<a class="btn btn-primary" href="<?php print $this->createUrl('u/checkout',array('a'=>$umkm->umkm_alias))?>"><i class="icon-hand-right icon-white"></i> Lanjut</a>
</div>
