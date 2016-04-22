<?php 
$errors = $this->session->flashdata('errors');
$errors2 = $this->session->flashdata('errors2');
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
                    <?php if(isset($errors['name'])){ ?>
                        <p class="warning"><?= $errors['name']; ?></p>
                    <?php  } ?>			
				<label for="name">Name: <input type="text" placeholder="John Smith" name="name" /></label>
	                <?php if(isset($errors['username'])){ ?>
	                    <p class="warning"><?= $errors['username']; ?></p>
	                <?php  } ?>						
                <label for="username">Username: <input type="text" placeholder="Johnny" name="username" /></label>
	                <?php if(isset($errors['email'])){ ?>
	                    <p class="warning"><?= $errors['email']; ?></p>
	                <?php  } ?>						
                <label for="email">E-Mail: <input type="text" placeholder="something@something.com" name="email" /></label>
                    <?php if(isset($errors['password'])){ ?>
                        <p class="warning"><?= $errors['password']; ?></p>
                    <?php  } ?>						
				<label for="password">Password: <input type="password" placeholder="********" name="password" /></label>
				<p>*Password should be at least 8 characters</p>
                    <?php if(isset($errors['confirmpass'])){ ?>
                        <p class="warning"><?= $errors['confirmpass']; ?></p>
                    <?php  } ?>						
				<label for="confirmpass">Confirm PW: <input type="password" placeholder="********" name="confirmpass" /></label>
				<input type="submit" value="Register" />
 			</fieldset>
 		</form>
 		<form id="login" action="/signin" method="post">
 			<fieldset>
 				<legend>Login</legend>
	                <?php if(isset($errors2['username'])){ ?>
	                    <p class="warning"><?= $errors2['username']; ?></p>
	                <?php  } ?>
                <label for="signin_username">Username: <input type="text" placeholder="something@something.com" name="username" /></label>
	                <?php if(isset($errors2['password'])){ ?>
	                    <p class="warning"><?= $errors2['password']; ?></p>
	                <?php  } ?>
                <label for="password">Password: <input type="password" placeholder="********" name="password" /></label>
                <input type="submit" name="action" value="Login" />
                </form>
 			</fieldset>
 		</form>
 	</div>
 </body>
 </html>