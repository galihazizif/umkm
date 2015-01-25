<?php
/* @var $this SiteController */
$dsp = isset($_GET['display']) ? $_GET['display'] : 'grid';
switch ($dsp) {
	case 'grid':
		$display = '_detail';
		break;
	case 'list':
		$display = '_detail_list';
		break;
	default:
		$display = '_detail';
		break;
}

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
							<input type="hidden" name="display" value="list">
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
				<div class="span7" =>
					<div class="btn-group pull-right">
					<a class="btn btn-mini" href="<?php echo $this->createUrl('site/index',array('display'=>'list'));?>"><i class="icon-list"></i> List</a>
					<a class="btn btn-mini" href="<?php echo $this->createUrl('site/index',array('display'=>'grid'));?>"><i class="icon-th"></i> Grid</a>
					</div>
					<?php if(isset($_GET['q'])):?>
						<h5><i class="icon-search"></i> Hasil Pencarian</h5>
						<?php if(trim($_GET['q']) == ''):?>
						Apa yang ingin anda cari? Silahkan masukan kata kunci untuk mencari produk.
						<?php else:?>
						Kata Kunci "<?php echo trim($_GET['q']);?>""
						<?php endif;?>
					<?php else:?>
						<h5><i class="icon-list"></i>  Daftar Produk Terbaru!</h5>
					<?php endif;?>
				</div>
			</div>
			<ul class="thumbnails">
		<?php $this->widget('zii.widgets.CListView', array(
			'dataProvider'=>$dataProvider,
			'itemView'=>$display,
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