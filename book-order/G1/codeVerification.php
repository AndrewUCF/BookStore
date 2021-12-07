<?php require_once "userAPIs.php"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Code Verification</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css"></link>
</head>
    <body>
        <div class="container">
            <div class = "centerHorizontal" style="font-size: 360%">
                Code Verification
            </div>
                <div class="EmailFormContainer">
                    <?php 
                        if(isset($_SESSION['info']))
                        {
                            ?>
                            <div class="alert alert-success text-center" style="padding: 0.4rem 0.4rem">
                                <?php echo $_SESSION['info']; ?>
                            </div>
                            <?php
                        }
                        ?>
                        <?php
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
                    <form action="codeVerification.php" method="POST" autocomplete="off">
                        <label style="text-align: left"> Verify Email</label>
                        <br>
                        <input class="form-control" type="number" name="temp-pass" placeholder="Enter code" required>
                        <br>
                        <button type = "submit" class="btn btn-primary" name="otp-passcode">Submit</button>
                    </form>
                </div>
            </div>
        </div>
        
    </body>
</html>