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
			<a class="brand" href="index.php"><?php echo PFrameWork::$config->get('site');?></a>
			 
			<!-- Everything you want hidden at 940px or less, place within here -->
			<div class="nav-collapse collapse">
        <ul class="nav">
        			<!-- TODO: Configure Friendly URLs -->
					<li <?php if ($page == "what") { ?>class="active"<?php } ?>><a href="index.php?page=what">What</a></li>	
					<li <?php if ($page == "who") { ?>class="active"<?php } ?>><a href="index.php?page=who">Who</a></li>
					<li><a href="mailto:<?php echo PFrameWork::$config->get('mail');?>">Contact</a></li>
				</ul>
			</div>		 
		</div>
	</div>
</div>
			<p style="text-align:center; margin-top: 5px"><span class="label label-info"><?php echo PFrameWork::$config->get('description');?></span></p>
