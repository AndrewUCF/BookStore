<?php require_once "userAPIs.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>G1 Book Ordering</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="./styles.css"></link>
</head>
    <body>
		<div class = "container">
			<div class = "centerHorizontal" style="font-size: 360%">
				Reset Password
			</div>
            <br>
			<div class = "EmailFormContainer">
				<form action="codeVerification.php" method="POST" autocomplete="off">

                    <?php
                        if(count($errors)>0){
                        ?>
                        <div class="alert alert-danger text-center">
                            <?php 
                                foreach($errors as $error)
                                {
                                    echo $error;
                                }
                            ?>
                        </div>
                        <?php
                        }
                    ?>
					<label style= "text-align: left">Enter Email</label><br>
					<input type = "text" class="form-control" name = "email" placeholder="john@gmail.com" required><br>
                    <button type = "submit" class="btn btn-primary" name="verify-email">Submit</button>
                </form>
			</div>
		</div>
	</body>



</html>