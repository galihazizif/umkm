<?php
/* @var $this ControlpanelController */

$this->breadcrumbs=array(
	'Pesan',
);
$this->pageTitle = Yii::app()->name.' - Pesan';
?>
<h4><i class="icon-envelope"></i> Pesan Masuk</h4>
<hr>
<div class="row">
	<div class="span8">
		<small>
		<table class="table table-condensed table-hover table-bordered">
			<tr>
				<th>
					Pengirim
				</th>
				<th>
					Tanggal
				</th>
				<th>
					Judul
				</th>
				<th>
					...
				</th>
			</tr>
			<?php foreach($model as $row):?>
				<tr <?php print ($row->pes_status == 0)? 'class="info"' : ''?>>
					<?php if($row->pes_pengirimtipe == LevelLookup::ACCOUNT_UMKM):?>
						<td><?php echo $row->pesPengirimUmkm->admin_email.' <small class="label label-info">'.LevelLookup::getAccountLabel($row->pes_pengirimtipe).'</small>' ?></td>
					
					<?php elseif($row->pes_pengirimtipe == LevelLookup::ACCOUNT_SYSADMIN):?>
						<td><?php echo $row->pesPengirimSysAdmin->sys_email.' <small class="label label-info">'.LevelLookup::getAccountLabel($row->pes_pengirimtipe).'</small>' ?></td>
					
					<?php elseif($row->pes_pengirimtipe == LevelLookup::ACCOUNT_VISITOR):?>
						<td><?php echo $row->pesPengirimPengunjung->pgj_email.' <small class="label label-info">'.LevelLookup::getAccountLabel($row->pes_pengirimtipe).'</small>' ?></td>
					<?php elseif($row->pes_pengirimtipe == 0):?>
						<td>Tamu</td>
					<?php endif; ?>
					<td><?php echo date_format(date_create($row->pes_tanggal),'d M Y / H:i:s'); ?></td>
					<td><?php echo $row->pes_judul; ?></td>
					<td>
						<a href="<?php echo $this->createUrl('controlpanel/balaspesan',array('idpesan'=>$row->pes_id));?>" class="btn btn-warning btn-mini">Lihat</a>
					</td>
				</tr>
			<?php endforeach;?>
		</table>
		</small>
			
	</div>
	</div>
	<div class="row">
 	<div class="pagination span7">
 		<?php $this->widget('CLinkPager',array(
 			'pages'=>$pagination,
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