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
		<div class = "containerLarge">
			<div class = "centerHorizontal">
				<p>Faculty List</p>
			</div>
			<div class = "bookInfo">
				<?php
					$info = mysqli_query($con, "SELECT * FROM Faculty");
					
					while($data = mysqli_fetch_array($info))
					{
				?>
				<form method="POST" autocomplete="off">
					<div class="row">
						<div class="col">	
							<?php if($data['admin']) : ?>
								<b style="color: blue">Admin</b><br>
							<?php endif; ?>
							<b>Name:</b> <?php echo $data['name']; ?></br>
							<b>Email:</b> <?php echo $data['email']; ?></br>
							</br>
						</div>
						<div class="col">
							<div class="centerVertical">
								<input type="hidden" name="email" value="<?php echo $data['email']; ?>" />
								<?php if(!$data['admin']) : ?>
									<button type="submit" name="bookInvite" class="btn btn-primary btn-lg">Invite to Request Books</button>
								<?php else : ?>
									<button type="submit" class="btn btn-primary btn-lg" disabled>Invite to Request Books</button>
									<button type="submit" name="deleteAdmin" class="btn btn-danger btn-lg">Delete Admin</button>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</form>
			<?php
				}
			?>
			</div>
			<div class="emptyGap"></div>
			<div class="centerHorizontal">
				<a href="./staff.php">
					<button type="button" class="btn btn-primary btn-lg">Back to Staff View</button>
				</a>
			</div>
		</div>
	</body>
</html>