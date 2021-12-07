<?php

session_start();
require "connection.php";
$email = "";

    $getProf = "SELECT email FROM faculty F WHERE F.admin = 0 AND F.UserID IN (SELECT B.UserID FROM books B WHERE B.semester ='Spring 2022')";
    //$getProf2 = "SELECT email FROM faculty F WHERE F.admin = 0 AND F.UserID IN (SELECT B.UserID FROM books B WHERE B.semester ='Fall 2021')";
	$query_data =  mysqli_query($con, $getProf);
    if ($query_data == true)
    {
        while($row = mysqli_fetch_array($query_data))
        {
            $emails[] = $row['email'];
            //echo "added data to array\n";
        }     
    }   
	
	foreach ($emails as $email) 
    {
		$getProf = "SELECT email FROM Faculty WHERE email = '$email'";
		
		do {
			if(!mysqli_query($con, $getProf))
				break;

			$subject = "Reminder";
			$message = "
				<html>
					<head>
						<title>The deadline is near!</title>
					</head>
					<body>
						<p>The dealine for your book request is near, please submit your request before Dec. 31.</p><br/>
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
?>