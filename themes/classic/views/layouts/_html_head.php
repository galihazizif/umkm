<head>
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	<meta charset="UTF-8">
	<meta property="description" content="Unyumas, memudahkan Pengusaha di wilayah Banyumas dan sekitarnya mengenalkan produknya.">
	<?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
	<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl?>/public/assets/js/bootstrap.js"></script>
	<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl?>/public/assets/js/bootstrap-collapse.js"></script>
	<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl?>/public/assets/js/bootstrap-tab.js"></script>
	<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl?>/public/assets/js/bootstrap-modal.js"></script>
	<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl?>/public/assets/js/bootstrap-transition.js"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl?>/public/assets/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl?>/public/assets/css/bootstrap-responsive.css">
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl?>/public/assets/css/override.css">
	<link rel="icon" href="<?php echo Yii::app()->request->baseUrl?>/public/assets/img/favicon.ico">

	<script type="text/javascript" src="<?php print Yii::app()->request->baseUrl;?>/public/assets/js/override.js"></script>
	<?php if(!Yii::app()->user->isGuest): ?>
	<script type="text/javascript">
		function checkMessage(){
			poll = setTimeout(function(){$('#msg-notif,#msg-notif2').load("<?php echo CController::createUrl('controlpanel/cekunreadmessage')?>");
			 checkMessage();},45000);
		}		
		checkMessage();

	</script>
	<?php endif; ?>
</head>