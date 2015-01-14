<br>
<div class="row">
	<div class="offset1 span7">
	<form action="<?php print $this->createUrl('site/direktori');?>" class="form-inline" >
		<input type="text" name="q" placeholder="Cari UMKM" <?php print isset($_GET['q'])? 'value="'.$_GET['q'].'"':''; ?>>
		<button type="submit" class="btn btn-warning"><i class="icon-search icon-white"></i> Cari</button>
	</form>
	<?php $this->widget('zii.widgets.CListView', array(
			'dataProvider'=>$dataProvider,
			'itemView'=>'_direktori',
			'summaryText'=>'',
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
			'pagerCssClass'=>'pagination',
		)); ?>
		
	</div>
</div>
