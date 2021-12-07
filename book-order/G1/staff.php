<?php require_once "./userAPIs.php"; ?>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<title>Staff View</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<link rel = "stylesheet" href = "styles.css"></link>
	<body>
		<div class="centerHorizontal">	
			<div class="centerVertical">	
				<a href = "../index.php">
					<button type="button" class="btn btn-danger btn-l">Log out</button>
				</a>
			</div>
		</div>
		<div class = "containerLong">
			<div class = "centerHorizontal">
				<p>Admin Actions</p>
			</div>
			<form action="staff.php" method="POST" autocomplete="off">
					<?php 
					if(isset($_SESSION['info'])){
						?>
						<div class="alert alert-success text-center">
							<?php echo $_SESSION['info']; ?>
						</div>
						<?php
					}

					if(count($errors) > 0){
						?>
						<div class="alert alert-danger text-center">
							<?php
							foreach($errors as $showerror){
								echo $showerror;
							}
							?>
						</div>
						<?php
					}
					?>
				<div class = "loginFormContainer">
					<div class="form-group">
						<a href="./semesterSelect.php">
							<button type = "button" class="btn btn-primary btn-lg">View All Book Requests</button>
						</a>
					</div>
					<div class="form-group">
						<a href="./facultyView.php">
							<button type = "button" class="btn btn-primary btn-lg">View All Faculty</button>
						</a>
					</div>
					<div class="form-group">
						<button name="email-all" type = "submit" class="btn btn-primary btn-lg">Broadcast Email to All Professors</button>
					</div>
					<div class="emptyGap"></div>
					<h5><u>Add Account</u></h5>
					<div class="row align-items-center">
						<input type="text" name="name" class="form-control" placeholder = "John Doe">
						<input type="text" name="email" class="form-control" placeholder = "email@example.com">
						<div class="gap-2"/>
						<button type="submit" name="addNewProfessor" class="btn btn-primary">Add as Professor</button>
						<button type="submit" name="addNewAdmin" class="btn btn-primary">Add as Admin</button>
					</div>
				</div>
			</form>
		</div>
	</body>
</html>