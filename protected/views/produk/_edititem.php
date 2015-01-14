<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
	<h4 id="myModalLabel"><i class="icon-shopping-cart"></i> Sunting Stok Barang<small></small></h4>
	<p></p>
</div>
<div class="modal-body">
	<?php $form=$this->beginWidget('CActiveForm', array(
				'id'=>'item-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
				'enableAjaxValidation'=>false,
				)); ?>
	<table class="table">
		<tr>
			<td>Nama</td>
			<td><?php echo $model->itemProd->prod_nama;?></td>
		</tr>
		<tr>				
			<td>Stok Barang</td>
			<td><?php echo $form->textField($model,'item_stok',array('class'=>'span1'));?>
				<?php echo $form->error($model,'item_stok',array('class'=>'cerror')); ?>
			</td>
		</tr>
		<tr>
			<td colspan="2"><button type="button" onclick="newXhrSubmit(this,'#item-form')" class="btn btn-primary" u-url="<?php echo $this->createUrl('produk/edititem',array('id'=>$model->item_prod_id));?>">Simpan</button></td>
		</tr>
	</table>
	<?php $this->endWidget() ?>
</div>