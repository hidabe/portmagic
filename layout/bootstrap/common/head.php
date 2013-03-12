<!DOCTYPE html> 
<html> 
<head> 
	<title><?php echo PFrameWork::$config->get('site');?></title> 
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
  <link href="layout/bootstrap/library/css/bootstrap.css" rel="stylesheet">
	<link href="layout/bootstrap/library/css_add/sticky.css" rel="stylesheet">
  <link href="layout/bootstrap/library/css/bootstrap-responsive.css" rel="stylesheet">
	<script src="layout/bootstrap/library/js/bootstrap.min.js"></script>

	<link href="layout/bootstrap/mosaic/css/mosaic.css" rel="stylesheet">
	<script src="layout/bootstrap/mosaic/js/mosaic.1.0.1.min.js"></script>

	<script type="text/javascript">
	jQuery(function($){
		$('.bar2').mosaic({
			animation	:	'slide'		//fade or slide
		});
		$('.cover').mosaic({
			animation	:	'slide',	//fade or slide
			hover_x		:	'400px'		//Horizontal position on hover
		});
	});
	</script>
	<style>
		.mosaic-block {
			background:#003c52 url(../img/progress.gif) no-repeat center center !important;
		}
		.mosaic-backdrop {
			background-color: #FFF !important;
		}
	/* 3d9aeb */
		.mosaic-overlay {
			background-color: #FFF !important;
	/*		border-left: 1px solid #cacaca;*/
		}
		.mosaic-full {
			background-image: none;
	/*		background-color: #3d9aeb !important;*/
	/*		color: #000;*/
	/*		border-top: 1px solid #acacac;*/
			position:absolute;
			top:0;
			height:100%;
			width:100%;
		}
		#content{ width:<?php echo $width;?>; margin:0px auto; padding:0px 0px; }
		.clearfix{ display: block; height: 0; clear: both; visibility: hidden; }

		.detupper { text-transform:uppercase; }

		.details{ margin:15px 20px; color: #003c52; }
			h4{ font:300 16px 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height:160%; letter-spacing:0.15em; color:#fff;}
			p{ font:300 12px 'Lucida Grande', Tahoma, Verdana, sans-serif; color:#666; }
			a{ text-decoration:none; }

		.image_inside {
			text-align: center;
			padding: 10px 10px 0 10px;
		}
	</style>

</head> 
<body>
