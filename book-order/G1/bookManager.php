<?php require_once "./userAPIs.php"; ?>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<title>Professor View</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<link rel = "stylesheet" href = "styles.css"></link>
	<body>
		<div class = "containerLarge">
			<div class = "centerHorizontal">
				<p>Book Request Manager</p>
			</div>
			<div class = "bookInfo">
				<?php
					$info = mysqli_query($con,
						"SELECT *
						FROM Books
						WHERE books.UserID IN (
							SELECT UserID
							FROM faculty
							WHERE UserID IN (
								SELECT UserID
								FROM faculty
								WHERE email ='" . $_SESSION['email'] . "'
							)
						)"
					);
					
					while($data = mysqli_fetch_array($info))
					{
				?>
				<form method="POST" autocomplete="off">
					<div class="row">
						<div class="col">
							<b>Title:</b> <?php echo $data['book_title']; ?></br>
							<b>Author:</b> <?php echo $data['author_name']; ?></br>
							<b>Edition:</b> <?php echo $data['edition']; ?></br>
							<b>Publisher:</b> <?php echo $data['publisher']; ?></br>
							<b>ISBN:</b> <?php echo $data['ISBN']; ?></br>
							<b>Semester:</b> <?php echo $data['semester']; ?></br>
						</div>
						</br>
						<div class="col">
							<div class="centerVertical">
								<input type="hidden" name="bookID" value="<?php echo $data['BookID']; ?>" />
								<button type="submit" name="deleteBook" class="btn btn-primary btn-lg">Delete Book</button>
							</div>
						</div>
					</div>
				</form>
			<?php
				}
			?>
			</div>
			<div class="emptyGap"></div>
			<form method="POST" autocomplete="off">
				<div class="centerHorizontal">
					<a href="./professor.php">
						<button type="button" class="btn btn-primary btn-lg">Back to Professor View</button>
					</a>
					<button type="submit" name="clearRequests" class="btn btn-danger btn-lg">Wipe All Your Requests</button>
				</div>
			</form>
		</div>
	</body>
</html>