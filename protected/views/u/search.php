<?php

$this->pageTitle = $umkm->umkm_nama.' - Pencarian';

/*This is required for applying custom user interface for every umkm user*/
// $this->styler = array('body'=>array('background'=>$umkm->kustomisasi->kus_background));

?>

<div class="row">&nbsp;</div>
<?php $this->renderPartial('/u/_uSearchInput',array('umkm'=>$umkm));?>
<div class="row">
	<?php $this->renderPartial('/u/sidebar',array('umkm'=>$umkm));?>
		<div id="homecontent" class="span6 offset1 well" style="">
			<ul class="thumbnails">
		<?php $this->widget('zii.widgets.CListView', array(
			'dataProvider'=>$dataProvider,
			'itemView'=>'_detail',
			'summaryText'=>(isset($q))?'Hasil pencarian \''.$q.'\'':'Produk '.$umkm->umkm_nama,
			'summaryCssClass'=>'span3',
			'emptyTagName'=>'div',
			'emptyText'=>'Belum ada produk',
			'pager'=>array(
				'class'=>'CLinkPager',
				'header'=>' ',
				'firstPageCssClass'=>'',
				'nextPageLabel'=>'>',
				'prevPageLabel'=>'<',
				'firstPageLabel'=>'<<',
				'lastPageLabel'=>'>>',
				'hiddenPageCssClass'=>'disabled',
				'selectedPageCssClass'=>'active',
				'htmlOptions'=>array('class'=>'')),
			'pagerCssClass'=>'pagination span7',
		)); ?>
			</ul>

		</div>
</div>