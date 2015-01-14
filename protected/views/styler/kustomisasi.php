<?php
/* @var $this ControlpanelController */

$this->breadcrumbs=array(
	'Kustomisasi',
);
$this->pageTitle = Yii::app()->name.' - Kustomisasi';
?>
<style type="text/css">

#wrap{
	 width: 545px; height: 350px; padding: 0; overflow: hidden; 
	 border: solid white 10px;
}


#uframe{	
	border: solid transparent 5px;
	overflow:hidden;
	width: 1200px;
	height: 768px;
}

#uframe{
	 -ms-zoom: 0.45;
     -moz-transform: scale(0.45);
     -moz-transform-origin: 0 0;
     -o-transform: scale(0.45);
     -o-transform-origin: 0 0;
     -webkit-transform: scale(0.45);
     -webkit-transform-origin: 0 0;
     pointer-events: none;
}

#ifroverlay{
	position: absolute;
	top: 0px;left: 0px;
	border: solid 1px green;
	width: 450px; height: 350px;
	background: red;
	z-index: 999999;

}
</style>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl?>/public/assets/colorpicker/css/bootstrap-colorpicker.min.css">
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl?>/public/assets/colorpicker/js/bootstrap-colorpicker.min.js"></script>

	<div class="row">
		<div class="span6 well">
		<form action="<?php echo $this->createUrl('styler/kustomisasi');?>" method="POST" enctype="multipart/form-data">
		
		<div class="span2">
			<label for="section-scheme" class="label label-important">Skema Warna</label>
			<div id="section-scheme">
				<label for="scheme-background">Warna Boks
					<input id="scheme-background" type="text" name="scheme-background" readonly="readonly" class="colorpicker span2" onBlur="$(this).attr('style','background : '+this.value)">
				</label>
				<label for="scheme-foreground">Warna Font Boks
					<input id="scheme-foreground" type="text" name="scheme-foreground" readonly="readonly" class="colorpicker span2" onBlur="$(this).attr('style','background : '+this.value)">
				</label>
				<label for="scheme-link">Warna Tautan
					<input id="scheme-link" type="text" name="scheme-link" readonly="readonly" class="colorpicker span2" onBlur="$(this).attr('style','background : '+this.value)" >
				</label>
				<label for="scheme-font-color">Warna Font
					<input id="scheme-font-color" type="text" name="scheme-font-color" readonly="readonly" class="colorpicker span2" onBlur="$(this).attr('style','background : '+this.value)" >
				</label>
			</div>
		</div>
		<div class="span3">
			<label for="section-bg" class="label label-important">Background</label>
			<div id="section-bg">
				<label class="radio" for="bt1">Warna
					<input id="bt1" type="radio" name="background-type" value="color" onChange="bgTypeSelect(this)">
				</label>
				<label class="radio" for="bt2">Gambar
					<input id="bt2" type="radio" name="background-type" value="image" onChange="bgTypeSelect(this)">
				</label>
				<div id="bg-value">
						<small id="note-image" style="display:none">Gambar harus berekstensi .jpg /.jpeg /.png dan ukuran maksimal 400kB</small>
						<input style="display:none" id="bg-color" type="text" name="bg-color" readonly="readonly" class="colorpicker span2" onBlur="$(this).attr('style','background : '+this.value)" >
						<input style="display:none" id="bg-image" type="file" class="btn btn-warning btn-small span3" name="bg-image">
						<br/>
						<select style="display:none" id="bg-image-repeat" class="btn btn-small btn-warning" name="bg-image-repeat">
							<option value="no-repeat">Tanpa Pengulangan</option>
							<option value="repeat-x">Pengulangan Horisontal</option>
							<option value="repeat-y">Pengulangan Vertikal</option>
							<option value="repeat">Pengulangan Semua</option>
						</select>
				</div>	
			</div>
		</div>
		<div class="span7">
			<input type="submit" value="Simpan" class="btn btn-primary">
		</div>
		</form>
		</div>
	</div>


<code onclick="window.open('<?php echo $this->createAbsoluteUrl('u/1',array('a'=>$umkm->umkm_alias));?>', '_blank');">Preview</code>
<div onclick="window.open('<?php echo $this->createAbsoluteUrl('u/1',array('a'=>$umkm->umkm_alias));?>', '_blank');" id="wrap" class="well">
<iframe disabled="disabled" onclick="return false" id="uframe" src="<?php echo $this->createAbsoluteUrl('u/1',array('a'=>$umkm->umkm_alias));?>">Loading</iframe>
<!-- <div id="ifroverlay">aoeueo</div> -->
</div>
<script>

			$(function(){
		        $('.colorpicker').colorpicker();
		    });

			function cElement(namatag){
				return document.createElement(namatag);
			}

			function bgTypeSelect(x){
				if(x.value == 'color'){
					$('#bg-color').show();
					$('#note-image').hide();
					$('#bg-image').hide();
					$('#bg-image-repeat').hide();
				}else{
					$('#bg-color').hide();
					$('#bg-image').show();
					$('#note-image').show();
					$('#bg-image-repeat').show();
				}
			}

		  
</script>