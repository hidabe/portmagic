<?php require_once("layout/bootstrap/common/head.php"); ?>

			<?php require_once("layout/bootstrap/common/navbar.php");?>

      <!-- Begin page content -->
      <div class="container">
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

			</div>

<?php require_once("layout/bootstrap/common/foot.php"); ?>
