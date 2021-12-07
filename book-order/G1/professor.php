<?php require_once "./userAPIs.php"; ?>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<title>Professor View</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<link rel="stylesheet" href="styles.css"></link>
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
				<p>Professor Actions</p>
			</div>
			<form method="POST" autocomplete="off">
				<div>	
					<div class="form-group" style="text-align: center">
						<a href="./bookManager.php">
							<button type = "button" class="btn btn-primary btn-lg">Manage Book Requests</button>
						</a>
					</div>
					<div class="loginFormContainer" style="text-align: left">
						<label for="Book Title"><b>Book Title</b></label>
						<input type="text" placeholder="Tales of Database Systems" name="title" required>
						</br>
						<label for="Author names"><b>Author names</b></label>
						<input type="text" placeholder="Group 1" name="author" required>
						</br>
						<label for="Edition"><b>Edition</b></label>
						<input type="text" placeholder="1" name="edition" required>
						</br>
						<label for="Publisher"><b>Publisher</b></label>
						<input type="text" placeholder="Kien Hua" name="publisher" required>
						</br>
						<label for="ISBN"><b>ISBN</b></label>
						<input type="text" placeholder="9781234567897" name="isbn" required>
						</br>
						<label for="semester"><b>Semester</b></label>
						<input type="text" class="form-control" list="datalistOptions" name="semester" placeholder="Fall 2021">
						<datalist id="datalistOptions">
							<option value="Fall 2021">
							<option value="Spring 2022">
							<option value="Summer 2022">
							<option value="Fall 2022">
							<option value="Spring 2023">
							<option value="Summer 2023">
						</datalist>
						</br>
					</div>
					<div class="emptyGap"></div>
					<div class="form-group" style="text-align: center">
						<button type = "submit" name="addBook" class="btn btn-primary btn-lg">Add Book Request</button>
					</div>
				</div>
			</form>
		</div>
		</div>
	</body>
</html>