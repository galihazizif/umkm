<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
    	<h4 id="myModalLabel">Beli?</h4>
	<small>Tambahkan <span class="label label-important"><?php print $model->prod_nama; ?></span> kedalam keranjang belanja.</small>
</div>
<form id="addtocart">
<div class="modal-body">
	<table class="table table-condensed">
		<tr>
			<td>Nama</td>
			<td>:</td>
			<td><?php print $model->prod_nama; ?></td>
		</tr>
		<tr>
			<td>Deskripsi</td>
			<td>:</td>
			<td><?php print $model->prod_deskripsi; ?></td>
		</tr>
		<tr>
			<td>Harga</td>
			<td>:</td>
			<td><?php print 'Rp. '.number_format($model->prod_harga,2,',','.'); print ($model->prod_satuan != ''? ' / '.$model->prod_satuan: ''); ?></td>
		</tr>
		<tr>
			<td>Jumlah</td>
			<td>:<input type="hidden" id="item_prod_id" name="item_prod_id" value="<?php print $model->prod_id;?>"></td>
			<td><input name="item_qty" id="item_qty" type="text" class="span1" value="1">
				<?php if($cart->hasErrors('krj_qty')):?>
					<div class="cerror"><?php print $cart->getError('krj_qty');?></div>
				<?php endif;?>
			</td>
		</tr>
	</table>
</div>
</form>
<div class="modal-footer">
	<button type="button" id="xhrSubmitButton" onClick="xhrSubmitButton('',this.value,this.name);" name="#addtocart" value="<?php print $this->createUrl('produk/addtocart'); ?>" class="btn btn-primary">Tambahkan</button>
	<button type="button" class="btn btn" data-dismiss="modal" aria-hidden="true">Batal</button>
</div>
