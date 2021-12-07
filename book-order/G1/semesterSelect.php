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
			<form action="./bookRequests.php" class = "center" method="post">
				<h4>Choose what semester you want to view books from.</h4>
				<label for="semester"><b>Semester</b></label>
				<select class="form-control" name="bookFilter">
					<option value="Fall 2021">Fall 2021</option>
					<option value="Spring 2022">Spring 2022</option>
					<option value="Summer 2022">Summer 2022</option>
					<option value="Fall 2022">Fall 2022</option>
					<option value="Spring 2023">Spring 2023</option>
					<option value="Summer 2023">Summer 2023</option>
				</select>
				<div class="emptyGap"></div>
				<div class="centerHorizontal">
					<button name="chooseBookFilter" type="submit" class="btn btn-primary btn-lg">Show Selection</button>
				</div>
			</form>
		</div>
	</body>
</html>

