<?php
/* @var $this ControlpanelController */

$this->breadcrumbs=array(
	'Daftar Pemesanan',
);
$this->pageTitle = Yii::app()->name.' - List Transaksi';
?>
 <div class="span8">
 	<h4><i class="icon-check"></i> Daftar Transaksi</h4>
 	<hr>
 	<div class="row">
 		<div class="search-form span8">
 			<form action="<?php print $this->createUrl('controlpanel/vtransaksi'); ?>" class="form-inline">
 				<input type="text" name="q" placeholder="Kode Transaksi" value="<?php echo isset($_GET['q'])? $_GET['q']: '';?>">
 				<button type="submit" class="btn btn-warning"><i class="icon-search icon-white"></i> Cari</button>
 			</form>
 		</div>
 	</div>
 	<small>
 	<table class="table table-condensed table-hover table-bordered">
 		<tr>
 		<th>Kode Transaksi</th>
 		<th>Waktu Pemesanan</th>
 		<th>UMKM</th>
 		<th>Status</th>
 		<th>...</th>
 		</tr>
 <?php
foreach ($model as $key => $value) {

	switch ($value->trans_status) {
		case Transaksi::STATUS_ADD :
			$class = 'error';
			break;
		case Transaksi::STATUS_APPROVED :
			$class = '';
			break;
		case Transaksi::STATUS_PAID :
			$class = 'success';
			break;
		case Transaksi::STATUS_SENT :
			$class = 'warning';
			break;
		case Transaksi::STATUS_ABORTED :
			$class = 'info';
			break;
		default:
			$class = 'info';
			break;
	}

	print '<tr class="'.$class.'">';
	print('<td>'.$value->trans_kodetrans.'</td>');
	print('<td>'.date_format(date_create($value->trans_tanggal),'d/m/Y H:i:s').'</td>');
	print '<td>'.$value->transItem->itemProd->prodUmkm->umkm_nama.'</td>';
	print '<td>'.$value->getStatusLabel().'</td>';
	print '<td>';
	print '<a class="btn btn-mini btn-info" onclick="oAjaxLink(this,true)" u-url="'.$this->createUrl('controlpanel/transaksiinfo',array('kodetrans'=>$value->trans_kodetrans)).'"><i class="icon-info-sign icon-white"></i></a> ';
	print '</tr>';
}



 ?>
 	</table>
 	</small>
 	<div class="row">
 	<div class="pagination span7">
 	<?php $this->widget('CLinkPager',array(
 	'pages'=>$pages,
 	'header'=>' ',
 	'htmlOptions'=>array('class'=>''),
	'firstPageCssClass'=>'',
	'nextPageLabel'=>'>',
	'prevPageLabel'=>'<',
	'firstPageLabel'=>'<<',
	'lastPageLabel'=>'>>',
	'hiddenPageCssClass'=>'disabled',
	'selectedPageCssClass'=>'active',
	));?>
	</div>
	</div>

	<small>
		<table class="table table-condensed">
			<tr>
				<th>Status</th>
				<th>Keterangan</th>
			</tr>
			<tr>
				<td>
					Belum Dikonfirmasi
				</td>
				<td>
					Anda telah melakukan pemesanan namun pihak UMKM belum melakukan konfirmasi terhadap pesanan anda.
				</td>
			</tr>
			<tr>
				<td>
					Menunggu Pembayaran
				</td>
				<td>
					Pesanan telah dikonfirmasi pihak UMKM.
				</td>
			</tr>
			<tr>
				<td>
					Validasi Pembayaran
				</td>
				<td>
					UMKM akan memeriksa konfirmasi pembayaran anda.
				</td>
			</tr>
			<tr>
				<td>
					Sudah Dibayar
				</td>
				<td>
					Pembayaran anda telah diterima UMKM.
				</td>
			</tr>
			<tr>
				<td>
					Sudah Dikirim
				</td>
				<td>
					Pesanan anda sudah dikirim.
				</td>
			</tr>
		</table>



	</small>

</div>