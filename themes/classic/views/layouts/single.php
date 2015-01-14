<!DOCTYPE html>
<html manifest="<?php //echo CController::createUrl('styler/cachemanifest');?>">
<?php $this->renderPartial('//layouts/_html_head');?>
<body>
	<?php if(Yii::app()->user->hasFlash('info')): ?>
	<div id="top-notif" class="top-notif alert">
		<button type="button" class="close" style="color: white" data-dismiss="alert">&times;</button>
		<p><?php print Yii::app()->user->getFlash('info'); ?></p>
	</div>
	<script type="text/javascript">
		$('#top-notif').delay(10000).fadeOut(200);
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



			 <a title="Usaha Mikro Kecil Menengah" class="brand" href="#"><img src="<?php print Yii::app()->request->baseUrl; ?>/public/g3013.png" class="brandx"></a>


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
    			
   			</div>

		</div>
		
	</div> <!-- END Navbar !-->
	<div style="margin-top: 30px;">
		<?=$content?>
	</div>


	<?php $this->renderPartial('//layouts/footer');?>
	
	<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog">
  		<div class="modal-header" style="">
    		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
    		<h4 id="myModalLabel">Login</h4>
    		<small>Silahkan masukkan email yang telah didaftarkan</small>
  		</div>
  		<div class="modal-body" id="modal-body">
    		<form>
    			<div class="input-prepend span3"><span class="add-on"><i class="icon-user"></i></span><input type="text" placeholder="E-Mail" name="email"></div>
    			<div class="input-prepend span3"><span class="add-on"><i class="icon-lock"></i></span><input type="text" placeholder="Password" name="password"></div>    			
    		</form>
  		</div>
  		<div class="modal-footer">
    		<button class="btn btn-primary">Login</button>
  		</div>
	</div>
</body>
</html>
