<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
// $this->breadcrumbs=array(
// 	'Index',
// );

?>
<div class="row">
	<div class="span4 offset1" style="margin-bottom: 20px">
				<div id="searchform" style="">
					<form method="GET" action="<?php print CController::createAbsoluteUrl('site/index')?>">
						<h4>Apa yang ingin anda cari?</h4>
						<div class="input-append">
							<input id="mainsearch" style="height: 40px;" value="<?php echo isset($_GET['q']) ? trim($_GET['q']): '';?>" name="q" placeholder=" Cari...">
							<button class="btn btn-primary btn-large" type="submit"><i class="icon-search icon-white"></i></button>
						</div>
					</form>
				</div>

				<?php if(Yii::app()->user->isGuest):
						$this->renderPartial('_regshortcut');
						endif;
				 ?>
				
	</div>
	<!-- <div class="span4"> -->
		<div id="homecontent" class="span7" style="margin-top: 20px">
			<div class="row">
				<div class="span3">Produk Terbaru</div>
			</div>
			<ul class="thumbnails">
		<?php $this->widget('zii.widgets.CListView', array(
			'dataProvider'=>$dataProvider,
			'itemView'=>'_detail',
			'summaryText'=>'',
			'pager'=>array(
				'class'=>'CLinkPager',
				'maxButtonCount'=>4,
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
	<!-- </div> -->
</div> 