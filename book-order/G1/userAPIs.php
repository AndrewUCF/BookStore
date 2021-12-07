<?php 
session_start();
require "connection.php";
$errors = array();
$email = "";
$name = "";


// passwordReset.php page 
if(isset($_POST['verify-email']))
{
	// clear message variable
	$_SESSION['info'] = "";
	// query the database for an existing account pertaining to the email written
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $check_email = "SELECT * FROM faculty WHERE email='$email'";
    $result = mysqli_query($con, $check_email);

	// if account exist send mail containing a temp passcode 
    if(mysqli_num_rows($result)>0)
    {
		// Generate random code and update faculty with that temp code
        $code = rand(999999, 111111);
        $update_code = "UPDATE faculty SET otp = $code WHERE email = '$email'";
        $query =  mysqli_query($con, $update_code);

		// make email with message containg temp code
		$title = "Reset Code";
		$message = "Please enter this code: $code";
		$support = "From: bookDBSofficial@gmail.com";
		// send email
		if(mail($email, $title, $message, $support))
		{
			// update session variables with email
			$info = "We've sent a temporary code to your email : $email";
			$_SESSION['info'] = $info;
			$_SESSION['email'] = $email;
			header('location: codeVerification.php');
		}
		else
		{
			// error for failed attempt at sending email
			$errors['error_code'] = "Error sending code!";
		}	
    }
	else
	{
		// send error message if email doesnt pertain to an existing account.
        $errors['email'] = "No account found with this email address!";
    }
}

// code verification: submit temporary passcode
if(isset($_POST['otp-passcode']))
{
    $_SESSION['info'] = "";

	// query the db and check if user typed temporary code correctly 
    $temp_check = mysqli_real_escape_string($con, $_POST['temp-pass']);
    $verify_code = "SELECT * FROM faculty WHERE otp = $temp_check";
    $query2 = mysqli_query($con, $verify_code);

	// check for results and send to confirm page
    if(mysqli_num_rows($query2)>0)
    {
		// update message for next page
		$info = "Please create a secure password.";
        $_SESSION['info'] = $info;
		// get email and update session token
        $data = mysqli_fetch_assoc($query2);
        $email = $data['email'];
        $_SESSION['email'] = $email;
		// Finally send to 
        header('location: confirmPassword.php');
    }
	else
	{
        $errors['error_code'] = "Incorrect code!";
    }
}

// change password submit button
if(isset($_POST['submitnewpass']))
{
    $_SESSION['info'] = "";
	// 
	// check passwords match
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $confirmPassword = mysqli_real_escape_string($con, $_POST['confirmpassword']);
    if ($password !== $confirmPassword)
	{
        $errors['password'] = "Error: passwords did not match";
    } 
	else 
	{
		// if passwords match update db with new password and send to log in page
        $email = $_SESSION['email']; 
        $newPassword = "UPDATE faculty SET password = '$password' WHERE email = '$email'";
        $run_query = mysqli_query($con, $newPassword);
		$info = "Successfully changed password!";
        $_SESSION['info'] = $info;
        header('Location: ../index.php');
    }
}

// allows admin or professors to log in
if(isset($_POST['login']))
{
	// store email and password
	$email = mysqli_real_escape_string($con, $_POST['email']);
	$password = mysqli_real_escape_string($con, $_POST['password']);

	$_SESSION['email'] = $email;
	$_SESSION['password'] = $password;

	// check if valid email
	$users = "SELECT * FROM faculty WHERE email = '$email' AND password = '$password'";
	$users = mysqli_query($con, $users);

	if (mysqli_num_rows($users)) {
		// check if admin or professor
		$admins = "SELECT * FROM faculty WHERE email = '$email' AND password = '$password' AND admin = 1";
		$admins = mysqli_query($con, $admins);

		if(mysqli_num_rows($admins))
			header('location: ./G1/staff.php');
		else
			header('location: ./G1/professor.php');
	}
	else
		$errors['email'] = "Incorrect email or password.";
}

// broadcasts email to all professors to submit a book request
if(isset($_POST['email-all']))
{
	$getProf = "SELECT email FROM Faculty WHERE admin = 0";
	$query_data =  mysqli_query($con, $getProf);

	while($row = mysqli_fetch_array($query_data)) {
		$emails[] = $row['email'];
	}
	
	foreach ($emails as $email) {
		$password = rand(999999, 111111);

		$getProf = "SELECT email FROM Faculty WHERE email = '$email'";
		$setPassword = "UPDATE faculty SET password = $password WHERE email = '$email'";
		
		do {
			if(!mysqli_query($con, $getProf))
				break;
			if(!mysqli_query($con, $setPassword))
				break;

			$subject = "Book Request";
			$message = "
				<html>
					<head>
						<title>You were invited to request books, by Dec 31.</title>
					</head>
					<body>
						<p>Please use '$password' to log in or reset your password.</p><br/>
						<a href='http://localhost/book-order'>You can Log in here.</a>
					</body>
				</html>
			";

			// set content-type
			$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
			$headers .= 'From: bookDBSofficial@gmail.com' . "\r\n";

			mail($email, $subject, $message, $headers);
			
			$info = "We have broadcasted your email to the faculty!";
		} while(0);
	}
}

// lets admin add a new admin
if (isset($_POST['addNewAdmin'])) {
	$email = mysqli_real_escape_string($con, $_POST['email']);
	$name = mysqli_real_escape_string($con, $_POST['name']);

	$password = rand(999999, 111111);

	do {
		// check if name and email fields exist
		if (!strlen($email)) {
			break;
		}
		if (!strlen($name)) {
			break;
		}

		$insert_data = "INSERT INTO faculty (name, email, password, admin, otp)
			values('$name', '$email', '$password', '1', '0')";
		$run_query =  mysqli_query($con, $insert_data);

		// send email with OTP
		$subject = "Added as Admin";
		$message = "You were added as an Admin.\nPlease use '$password' to log in or reset your password.";
		$sender = "From: bookDBSofficial@gmail.com";
		if(mail($email, $subject, $message, $sender))
		{
			$info = "Added '$name' as Admin";
			$_SESSION['info'] = $info;
		}
	} while(0);
}

// lets admin add a new professor
if (isset($_POST['addNewProfessor'])) {
	$email = mysqli_real_escape_string($con, $_POST['email']);
	$name = mysqli_real_escape_string($con, $_POST['name']);

	$password = rand(999999, 111111);

	do {
		// check if name and email fields exist
		if (!strlen($email)) {
			break;
		}
		if (!strlen($name)) {
			break;
		}

		$insert_data = "INSERT INTO faculty (name, email, password, admin, otp)
			values('$name', '$email', '$password', '0', '0')";
		$run_query = mysqli_query($con, $insert_data);

		// send email with OTP
		$subject = "Added as Professor";
		$message = "You were added as a Professor.\n";
		$sender = "From: bookDBSofficial@gmail.com";
		if(mail($email, $subject, $message, $sender))
		{
			$info = "Added '$name' as Professor";
			$_SESSION['info'] = $info;
		}
	} while(0);
}

// invites a professor to submit a book request
if(isset($_POST['bookInvite']))
{
	$email = mysqli_real_escape_string($con, $_POST['email']);
	$password = rand(999999, 111111);

	$getProf = "SELECT email FROM Faculty WHERE email = '$email'";
	$setPassword = "UPDATE faculty SET password = '$password' WHERE email = '$email'";
	
	do {
		if(!mysqli_query($con, $getProf))
			break;
		if(!mysqli_query($con, $setPassword))
			break;

		$subject = "Book Request";
		$message = "
			<html>
				<head>
					<title>You were invited to request books, Please submit by Dec. 31.</title>
				</head>
				<body>
					<p>Please use '$password' to log in or reset your password.</p><br/>
					<a href='http://localhost/book-order'>You can Log in here.</a>
				</body>
			</html>
		";

		// set content-type
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		$headers .= 'From: bookDBSofficial@gmail.com' . "\r\n";

		mail($email, $subject, $message, $headers);
	} while(0);
}

// lets professors add a book request to their request form
if (isset($_POST['addBook'])) {
	$title = mysqli_real_escape_string($con, $_POST['title']);
	$author = mysqli_real_escape_string($con, $_POST['author']);
	$edition = mysqli_real_escape_string($con, $_POST['edition']);
	$publisher = mysqli_real_escape_string($con, $_POST['publisher']);
	$isbn = mysqli_real_escape_string($con, $_POST['isbn']);
	$semester = mysqli_real_escape_string($con, $_POST['semester']);

	$currentEmail = $_SESSION['email'];
	$getUserID = "SELECT UserID FROM Faculty WHERE email = '$currentEmail'";
	$user = mysqli_fetch_assoc(mysqli_query($con, $getUserID));
	$userID = $user['UserID'];

	$addBook = "INSERT INTO Books(book_title, author_name, edition, publisher, ISBN, UserID, semester)
		values('$title', '$author', '$edition', '$publisher', '$isbn', '$userID', '$semester')";

	mysqli_query($con, $addBook);
}

// clears a single book request from professor's book requests
if (isset($_POST['deleteBook'])) {
	$bookID = mysqli_real_escape_string($con, $_POST['bookID']);
	$deleteBook = "DELETE FROM Books WHERE BookID = $bookID";

	mysqli_query($con, $deleteBook);
}

// clears all of professor's book requests
if (isset($_POST['clearRequests'])) {
	$currentEmail = $_SESSION['email'];
	$getUserID = "SELECT UserID FROM Faculty WHERE email = '$currentEmail'";
	$user = mysqli_fetch_assoc(mysqli_query($con, $getUserID));
	$userID = $user['UserID'];

	$clearRequests = "DELETE FROM Books WHERE UserID IN (SELECT UserID FROM Faculty WHERE email = '$currentEmail')";
	mysqli_query($con, $clearRequests);
}

// lets admin view books by a certain semester
if (isset($_POST['chooseBookFilter'])) {
	$bookFilter = $_POST['bookFilter'];
	$_SESSION['bookFilter'] = $bookFilter;
}

// deletes specified admin
if(isset($_POST['deleteAdmin']))
{
	$email = mysqli_real_escape_string($con, $_POST['email']);
	$getProf = "DELETE FROM Faculty WHERE email = '$email'";
	mysqli_query($con, $getProf);
}
?>