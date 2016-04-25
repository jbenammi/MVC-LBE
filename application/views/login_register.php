<?php 
$login_error = $this->session->flashdata('login_error');
 ?>
 <!DOCTYPE html>
 <html lang="en">
 <head>
 	<meta charset="UTF-8">
 	<meta name="author" content="Jonathan Ben-Ammi">
 	<title></title>
 	<meta name="description" content="">
 	<link rel="stylesheet" type="text/css" href="">
 </head>
 <body>
 	 	<div class="container">
 		<h3>Welcome!</h3>
		<?php if(isset($login_error)){ ?>
			<p class="warning"><?= $login_error; ?></p>
		<?php  } ?>
 		<form id="Register" action="/register" method="post">
 			<fieldset>
				<legend>Register</legend> 

                    <?php echo form_error('name'); ?>
				<label for="name">Name: <input type="text" placeholder="John Smith" name="name" /></label>
                    <?php echo form_error('username'); ?>               					
                <label for="username">Username: <input type="text" placeholder="Johnny" name="username" /></label>
                    <?php echo form_error('email'); ?>
                <label for="email">E-Mail: <input type="text" placeholder="something@something.com" name="email" /></label>						
                    <?php echo form_error('password'); ?>
				<label for="password">Password: <input type="password" placeholder="********" name="password" /></label>
				<p>*Password should be at least 8 characters</p>
                    <?php echo form_error('confirmpass'); ?>
				<label for="confirmpass">Confirm PW: <input type="password" placeholder="********" name="confirmpass" /></label>
				<input type="submit" value="Register" />
 			</fieldset>
 		</form>
 		<form id="login" action="/signin" method="post">
 			<fieldset>
 				<legend>Login</legend>
	                <?php echo form_error('username'); ?>
                <label for="signin_username">Username: <input type="text" placeholder="something@something.com" name="username" /></label>
	                <?php echo form_error('password'); ?>
                <label for="password">Password: <input type="password" placeholder="********" name="password" /></label>
                <input type="submit" name="action" value="Login" />
                </form>
 			</fieldset>
 		</form>
 	</div>
 </body>
 </html>