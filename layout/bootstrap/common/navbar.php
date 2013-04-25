<div class="navbar">
	<div class="navbar-inner">
		<div class="container">
		 
			<!-- .btn-navbar is used as the toggle for collapsed navbar content -->
			<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</a>
			 
			<!-- Be sure to leave the brand out there if you want it shown -->
			<a class="brand" href="index.php"><?php echo PFrameWork::$config->get('header');?></a>
			 
			<!-- Everything you want hidden at 940px or less, place within here -->
			<div class="nav-collapse collapse">
        <ul class="nav pull-right">
        			<!-- TODO: Configure Friendly URLs -->
					<li <?php if ($page == "what") { ?>class="active"<?php } ?>><a href="<?php echo PRequest::getRoute('what');?>"><?php echo LANG_What;?></a></li>	
					<li <?php if ($page == "who") { ?>class="active"<?php } ?>><a href="<?php echo PRequest::getRoute('who');?>"><?php echo LANG_Who;?></a></li>
					<?php foreach($pages_custom as $pcustom) {
						$temp = explode('.',$pcustom); 
						$pc = $temp[0];
						$text = PModel::getFile(PFrameWork::$config->get('dir') . 'layout/bootstrap/custom/' . $pc . '.txt');
					?>
					<li <?php if ($page == $pc) { ?>class="active"<?php } ?>><a href="<?php echo PRequest::getRoute($pc);?>"><?php echo $text;?></a></li>
					<?php } ?>
					<li <?php if ($page == "contact") { ?>class="active"<?php } ?>><a href="<?php echo PRequest::getRoute('contact');?>"><?php echo LANG_Contact;?></a></li>
				</ul>
			</div>		 
		</div>
	</div>
</div>
	<div class="description">
			<div class="container">
				<?php echo PFrameWork::$config->get('description');?>
			</div>
	</div>
