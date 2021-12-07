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
				<p>Book Requests</p>
			</div>
			<div class = "bookInfo">
				<?php
					$bookFilter = $_SESSION['bookFilter'];

					$info = mysqli_query($con, "SELECT * FROM Books WHERE semester = '$bookFilter'");
					
					while($data = mysqli_fetch_array($info))
					{
						$userID = $data['UserID'];
						$requester = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM Faculty WHERE UserID = '$userID'"));
				?>
						<tr>
							<b>Title:</b> <?php echo $data['book_title']; ?></br>
							<b>Author:</b> <?php echo $data['author_name']; ?></br>
							<b>Publisher:</b> <?php echo $data['publisher']; ?></br>
							<b>Edition</b> <?php echo $data['edition']; ?></br>
							<b>ISBN:</b> <?php echo $data['ISBN']; ?></br>
							<b>Requester:</b> <?php echo $requester['name']; ?></br>
							<b>Semester:</b> <?php echo $data['semester']; ?></br>
							</br>
						</tr>
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