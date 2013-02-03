<?php require_once("layout/bootstrap/common/head.php"); ?>

      <!-- Begin page content -->
      <div class="container">
        <div class="page-header">
          <h1><?php echo PFrameWork::$config->get('site');?></h1>
        </div>

				<p class="lead">About us</p>
				<p><?php echo PFrameWork::$config->get('description');?></p>

        <p class="lead">What are we doing?</p>

				<div id="myCarousel" class="carousel slide">
					<!-- Carousel items -->
					<div class="carousel-inner">
						<?php 
						$i = 0;
						foreach($webs as $web) { ?>
							<div class="item<?php if ($i == 0) echo ' active';?>">
								<a target="_blank" href="<?php echo $web->getUrl();?>">
									<img src="<?php echo $web->getImageMain();?>" />
									<div class="carousel-caption">
										<h4><?php echo $web->getTitleShort();?></h4>
										<p><?php echo $web->getDate();?></p>
										<?php foreach($web->getSkills() as $skill) { ?>
											<img width="40px" src="<?php echo PModel::getImageFromSkill($skill);?>"></img>
										<?php } ?>
									</div>
								</a>
							</div>
						<?php $i++; } ?>
					</div>
					<!-- Carousel nav -->
					<a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
					<a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
				</div>

				<div class="clr"></div>
        <p class="lead">Who do it?</p>
				<div class="row-fluid">
					<?php foreach($profiles as $profile) { 
/*
echo '<pre>';
print_r($profile);
echo '</pre>';
*/	
						$img_avatar = PModel::getAvatar($profile);
						?>
						<div class="mosaic-block cover">
							<div class="mosaic-overlay">
								<div class="details">
									<?php echo $profile['first_name'];?> <?php echo $profile['last_name'];?>
								</div>
								<div class="image_inside">
									<img src="<?php echo $img_avatar;?>"/>
								</div>
							</div>
							<a href="http://about.me/<?php echo $profile['user_name'];?>" target="_blank" class="mosaic-backdrop">
								<div class="details">
									<b><?php echo $profile['first_name'];?> <?php echo $profile['last_name'];?></b>					
									<?php if ($profile['header'] != "") { ?>
										<br/>
										<i><?php echo $profile['header'];?></i>
									<?php } ?>
									<?php if (count($profile['tags']) != 0) { ?>
										<br/>
										<?php foreach($profile['tags'] as $pr) { ?>
										<u><?php echo $pr;?></u>
										<?php } ?>
									<?php } ?>
									<p><?php echo $profile['bio'];?></p>
								</div>
							</a>

						</div>

<!--
						<a class="span4 original visible" href="#" id="original_<?php echo $profile['user_name'];?>">
							<img src="<?php echo PModel::getAvatar($profile);?>"></img>
						</a>
						<div class="span4" style="display:none" id="toggle_<?php echo $profile['user_name'];?>">
							<h4><?php echo $profile['last_name'];?></h4>
							<p>oajdfoia foid fio fioa foia f</p>
						</div>
-->
					<?php } ?>
				</div>

	    </div>

<?php require_once("layout/bootstrap/common/foot.php"); ?>
