<!DOCTYPE html>
<html>
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
    						'activeCssClass'=>'active',
    						'htmlOptions' => array('class'=>'nav'),
    					));

    				?>
   			</div>
   			<?php $this->renderPartial('//u/navbar_checkout');?>
    			
   			</div>

		</div>
		
	</div> <!-- END Navbar !-->

<div class="container">
	<!-- <div class="row"> -->
		<div class="row">
		<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
			'separator' => '<span class="divider"> / </span>',
			'htmlOptions' => array('class' => 'breadcrumb'),
			'tagName' => 'ul',
			'inactiveLinkTemplate' => "<li class='active'><a href='#' >{label}</a></li>",
			'activeLinkTemplate' => "<li><a href= {url} > {label} </a></li>",
		)); ?><!-- breadcrumbs -->
	<?php endif?>
		</div>
	<!-- </div> -->
	<div class="row">

	<?php

		if(Yii::app()->user->isUmkm()){
			$menu = array(
						array('label'=>'<i class="icon-wrench"></i> Pengaturan Akun', 'url'=>array('/controlpanel/index')),
						array('label'=>'<i class="icon-check"></i> Transaksi', 'url'=>array('/controlpanel/transaksi')),
						array('label'=>'<i class="icon-gift"></i> Produk', 'url'=>array('/produk/admin')),
						array('label'=>'<i class="icon-plus-sign"></i> Tambah Produk','url'=>array('/produk/create')),
						array('label'=>'<i class="icon-star"></i> Kustomisasi', 'url'=>array('/styler/kustomisasi')),
						array('label'=>'<i class="icon-tasks"></i> Pages', 'url'=>array('/pages/admin')),
						array('label'=>'<i class="icon-envelope"></i> Pesan', 'url'=>array('/controlpanel/cekpesan')),
						
			);	
		}else if(Yii::app()->user->isSysAdmin()){
			$menu = array(
						array('label'=>'<i class="icon-wrench"></i> Rangkuman', 'url'=>array('/controlpanel/index')),
						array('label'=>'<i class="icon-check"></i> Data UMKM', 'url'=>array('/umkm/admin')),
						array('label'=>'<i class="icon-star"></i> Data Pengelola UMKM', 'url'=>array('/admin/admin')),
						array('label'=>'<i class="icon-gift"></i> Data Produk', 'url'=>array('/produk/admin')),
						array('label'=>'<i class="icon-tasks"></i> Data Pengunjung', 'url'=>array('/pengunjung/admin')),
						array('label'=>'<i class="icon-plus-sign"></i> Data Transaksi','url'=>array('/transaksi/admin')),
						array('label'=>'<i class="icon-star"></i> Data Kategori Produk', 'url'=>array('/kategoriproduk/admin')),
						array('label'=>'<i class="icon-star"></i> Data Kategori Atribut', 'url'=>array('/kategoriatribut/admin')),
						array('label'=>'<i class="icon-star"></i> Data Halaman UMKM', 'url'=>array('/pages/admin')),
						array('label'=>'<i class="icon-envelope"></i> Pesan', 'url'=>array('/controlpanel/cekpesan')),
												
			);	
		}else if(Yii::app()->user->isPengunjung()){
			$menu = array(
						array('label'=>'<i class="icon-wrench"></i> Pengaturan Akun', 'url'=>array('/controlpanel/index')),
						array('label'=>'<i class="icon-check"></i> Transaksi', 'url'=>array('/controlpanel/vtransaksi')),
						array('label'=>'<i class="icon-envelope"></i> Pesan', 'url'=>array('/controlpanel/cekpesan')),

			);
		}
		if(!Yii::app()->user->isGuest){
		echo "<div class='span3 sidemenu'>";
		$this->widget('zii.widgets.CMenu',array(
			'items'=>$menu,
			'encodeLabel'=>false,
			'htmlOptions' => array('class'=>'nav nav-list'),
		)); 
		echo "</div>";
		}
		?>

		<div style="" class="span8 conditionedcontainer">
			<?php echo $content;?>
		</div>
	</div>

	 <!-- END Main Container !-->
</div>
	<?php $this->renderPartial('//layouts/footer');?>
	<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog">
  		<p class="loading-icon">Loading.. <img src="<?php print Yii::app()->baseUrl ?>/public/assets/img/ajax-loader.gif"></p>
	</div>
</body>
</html>
