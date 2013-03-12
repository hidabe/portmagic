<?php require_once("layout/bootstrap/common/head.php"); ?>

			<?php require_once("layout/bootstrap/common/navbar.php");?>

      <div class="container">
        <p class="lead">Who does it?</p>
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
									<img src="<?php echo $img_avatar;?>" height="155px"/>
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

					<?php } ?>
				</div>

	    </div>

<?php require_once("layout/bootstrap/common/foot.php"); ?>
