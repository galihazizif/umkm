<?php
/* @var $this ControlpanelController */

$this->breadcrumbs=array(
	'Daftar Transaksi',
);
$this->pageTitle = Yii::app()->name.' - List Transaksi';
?>
 <div class="span8">
 	<h4>Daftar Pemesanan Produk</h4>
 	<hr>
 	<div class="row">
 		<div class="search-form span8">
 			<form action="<?php print $this->createUrl('controlpanel/transaksi'); ?>" class="form-inline">
 				<input type="text" name="q" placeholder="Kode Transaksi" <?php echo isset($_GET['q'])? 'value="'.$_GET['q'].'"': '';?>>
 				<button type="submit" class="btn btn-warning"><i class="icon-search icon-white"></i> Cari</button>
 			</form>
 		</div>
 	</div>
 	<small>
 	<table class="table table-condensed table-hover table-bordered">
 		<tr>
 		<th>Nama</th>
 		<th>Kode Transaksi</th>
 		<th>Waktu Pemesanan</th>
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
	}

	print '<tr class="'.$class.'">';
	print('<td>'.$value->transPgj->pgj_nama.'</td>');
	print('<td>'.$value->trans_kodetrans.'</td>');
	print('<td>'.date_format(date_create($value->trans_tanggal),'d/m/Y H:i:s').'</td>');
	print '<td>'.$value->getStatusLabel().'</td>';
	print '<td>';
	
	if($value->trans_status == Transaksi::STATUS_ADD){
		print '<a class="btn btn-mini btn-primary" onclick="oAjaxLink(this,true)" u-url="'.$this->createUrl('controlpanel/transaksidetail',array('kodetrans'=>$value->trans_kodetrans)).'"><i class="icon-ok icon-white"></i></a> ';
		print '<a class="btn btn-danger btn-mini" onclick="oAjaxLink(this,true)" u-url="'.$this->createUrl('controlpanel/transaksiabort',array('kodetrans'=>$value->trans_kodetrans)).'"><i class="icon-remove icon-white"></i></a>';
	}else if($value->trans_status == Transaksi::STATUS_APPROVED){
		print '<a class="btn btn-mini btn-primary" onclick="oAjaxLink(this,true)" u-url="'.$this->createUrl('controlpanel/transaksipayment',array('kodetrans'=>$value->trans_kodetrans)).'"><i class="icon-ok icon-white"></i></a> ';
	}else if($value->trans_status == Transaksi::STATUS_PAID){
		print '<a class="btn btn-mini btn-primary" onclick="oAjaxLink(this,true)" u-url="'.$this->createUrl('controlpanel/transaksipaid',array('kodetrans'=>$value->trans_kodetrans)).'"><i class="icon-ok icon-white"></i></a> ';
	}else{
		print '<a class="btn btn-mini btn-info" onclick="oAjaxLink(this,true)" u-url="'.$this->createUrl('controlpanel/transaksiinfo',array('kodetrans'=>$value->trans_kodetrans)).'"><i class="icon-info-sign icon-white"></i></a> ';
	}
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
</div>