<?php require_once "./G1/userAPIs.php"; ?>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    
	<title>G1 Book Ordering</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> -->
	<link rel = "stylesheet" href = "index.css"></link>
	<body>
		<div class = "container">
			<div class = "centerHorizontal">
				<p>Login</p>
			</div>
			<?php
			if(count($errors) == 1){
				?>
				<div class="alert alert-danger text-center">
					<?php
					foreach($errors as $showerror){
						echo $showerror;
					}
					?>
			</div>
			<?php
			}elseif(count($errors) > 1){
				?>
				<div class="alert alert-danger">
					<?php
					foreach($errors as $showerror){
						?>
						<li><?php echo $showerror; ?></li>
						<?php
					}
					?>
				</div>
				<?php
			}
			?>	
			<div class = "loginFormContainer">
				<form action="index.php" method="POST" autocomplete="">
					<label>Email:</label><br>
					<input type = "text" class="form-control" name="email"><br>
					<label>Password:</label><br>
					<input type = "password" class="form-control" name="password"><br><br>
					<input type = "submit" name="login">
				</form>
				<a href="./G1/passwordReset.php">
					  <p>Reset Password</p>
				</a>
			</div>
		</div>
	</body>
	</html>