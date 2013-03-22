<?php require_once("layout/bootstrap/common/head.php"); ?>

<?php require_once("layout/bootstrap/common/navbar.php");?>

      <!-- Begin page content -->
	<div class="container">
		<p class="lead">Contact us</p>
		
		<form action="sendEmail.php" method="POST" class="form-horizontal" onSubmit="return validaEmail(this.email.value);">
  			<div class="control-group">
    				<label class="control-label" for="name">Name</label>
    				<div class="controls">
      					<input type="text" name="name" id="name" required>
    				</div>
  			</div>
  			<div class="control-group">
    				<label class="control-label" for="email">Email</label>
    				<div class="controls">
      					<input type="text" name="email" id="email" placeholder="user@domain.com" required>
    				</div>
  			</div>
			<div class="control-group">
    				<label class="control-label" for="message">Message</label>
    				<div class="controls">
      					<textarea rows="3" name="message" id="message" required></textarea>
    				</div>
  			</div>
			<button style="margin-left: 340px;" class="btn" type="submit" >Send</button>
  		</form>
	</div>

<?php require_once("layout/bootstrap/common/foot.php"); ?>
