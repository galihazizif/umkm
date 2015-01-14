<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>

<div class="row">
	<div class="offset1 span4 sidemenu pull-right">
	<?php
		$this->beginWidget('zii.widgets.CPortlet', array(
			
		));
		$this->widget('zii.widgets.CMenu', array(
			'items'=>$this->menu,
			'linkLabelWrapper'=>'span',
			'encodeLabel'=>false,
			'linkLabelWrapperHtmlOptions'=>array('class'=>'btn btn-mini'),
			'htmlOptions'=>array('class'=>'levelmenu pull-right','style'=>'margin: 5px 5px 5px 0 '),
		));
		$this->endWidget();
	?>
	</div><!-- sidebar -->
</div>
<div class="span-19">
	<div id="content">
		<?php echo $content; ?>
	</div><!-- content -->
</div>
<?php $this->endContent(); ?>