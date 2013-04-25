<?php require_once("layout/bootstrap/common/head.php"); ?>

			<?php require_once("layout/bootstrap/common/navbar.php");?>

      <div class="container">
        <p class="lead"><?php echo LANG_Who_does_it;?></p>
				<div class="row-fluid avatars">
					<?php foreach($profiles as $profile) { 
/*
echo '<pre>';
print_r($profile);
echo '</pre>';
*/	
						$img_avatar = PModel::getAvatar($profile);
						?>
						<div class="span4 well">
							<h3><?php echo $profile['first_name'];?> <?php echo $profile['last_name'];?></h3>
							<a href="http://about.me/<?php echo $profile['user_name'];?>" target="_blank"><img src="<?php echo $img_avatar;?>" height="155px"/></a>
							<p><?php echo $profile['header'];?></p>
						</div>
					<?php } ?>
				</div>

	    </div>

<?php require_once("layout/bootstrap/common/foot.php"); ?>
