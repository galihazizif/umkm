<!DOCTYPE html>
<html>
<?php $this->renderPartial('//layouts/_html_head');?>
<?php if(isset($this->styler)): ?>
		<style type="text/css">
		<?php
		echo $this->styler;
		?>
		</style>
	<?php endif;?>
<body>
	<?php if(Yii::app()->user->hasFlash('info')): ?>
	<div id="top-notif" class="top-notif alert">
		<button type="button" class="close" style="color: white" data-dismiss="alert">&times;</button>
		<p><?php print Yii::app()->user->getFlash('info'); ?></p>
	</div>
	<script type="text/javascript">
		$('#top-notif').delay(9000).fadeOut(200);
	</script>
	<?php endif;?>
<div class="navbar navbar-fixed-top">
	<div class="navbar-inner">
		<div class="container">
			
			<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</a>
			<?php
			$menu = array(
				array('label'=>'<i class="icon-home icon-white"></i> Home', 'url'=>array('/site/index')),
				array('label'=>'<i class="icon-th icon-white"></i> Direktori', 'url'=>array('/site/direktori')),
				array('label'=>'<i class="icon-envelope icon-white"></i> Contact', 'url'=>array('/site/contact')),
				array('label'=>'<i class="icon-lock icon-white"></i> Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
				);
				?>

				<div class="nav-collapse collapse">
					<?php
					$this->widget('zii.widgets.CMenu',array(
						'items' => $menu,
						'encodeLabel'=>false,
						'htmlOptions' => array('class'=>'nav'),
						));

						?>
					</div>
					<?php $this->renderPartial('//u/navbar_checkout');?>
							<!-- <form class="navbar-form pull-right" method="GET" action="">
									<div class="input-append">
  										<input name="q" class="span4" placeholder="" id="appendedInputButtons" type="text">
  										<button onclick="submit();" type="button" class="btn btn-warning"><i class="icon-white icon-search"></i></button>
									</div>
								</form> -->
							</div>
						</div>
					</div> <!-- END Navbar !-->

					<div style="margin-top: 30px">
						<?=$content?>
					</div>



					<?php $this->renderPartial('//layouts/footer');?>


					<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog">
					</div>
				</body>
				</html>
