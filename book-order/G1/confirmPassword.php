<?php require_once "userAPIs.php"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>newPassword</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="styles.css"></link>
</head>
<body>
    <div class="container">
        <div class="centerHorizontal">
            New Password
        </div>    
            <div class="EmailFormContainer">
                <form action="confirmPassword.php" method="POST" autocomplete="off">
                    <?php 
                    if(isset($_SESSION['info']))
                    {
                        ?>
                        <div class="alert alert-success text-center">
                            <?php echo $_SESSION['info']; ?>
                        </div>
                        <?php
                    }
                    ?>
                    <?php
                    if(count($errors)>0)
                    {
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
                    <input type="password" class="form-control" placeholder="new password" name="password" required>
                    <br>
                    <input type="password" class="form-control" placeholder="Confirm new password" name="confirmpassword" required>
                    <br>
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit" name="submitnewpass">Change</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
</body>

</html>