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
		.clearfix{ display: block; height: 0; clear: both; visibility: hidden; }


		.details{ margin:15px 20px; color: #FFF; }	

		.image_inside {
			padding: 0px 20px;
		}
	</style>

</head> 
<body>
