<br>
<div class="row">
	<div class="offset1 span7">
	<form action="<?php print $this->createUrl('site/direktori');?>" class="form-inline" >
		<input type="text" name="q" placeholder="Cari UMKM" <?php print isset($_GET['q'])? 'value="'.trim($_GET['q']).'"':''; ?>>
		<button type="submit" class="btn btn-warning"><i class="icon-search icon-white"></i> Cari</button>
	</form>
	<?php if(isset($_GET['q'])):?>
		<h5><i class="icon-search"></i> Hasil Pencarian</h5>
			<?php if(trim($_GET['q']) == ''):?>
				Masukan kata kunci untuk menyaring daftar UMKM.
			<?php else:?>
				Kata Kunci "<?php echo trim($_GET['q']);?>""
			<?php endif;?>
	<?php else:?>
		<h5><i class="icon-list"></i> UMKM yang telah terdaftar</h5>
	<?php endif;?>
	
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
