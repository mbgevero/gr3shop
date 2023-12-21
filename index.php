<?php
include 'db.php';

if(isset($_POST['register'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    


    $hash = password_hash($password, PASSWORD_DEFAULT);

    $insert_query=mysqli_query($conn,"insert into `user_data` (username,password) values 
    ('$username','$hash')") or die ("Insert query failed");
    if($insert_query) {
        echo "<span style='color: white;'>Account Created</span>";
        header("Location: signin.php");
        exit;
    }else{
        echo"Sign up failed!";
    }
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>

    <!-- bootstrap css link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!--  font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- stylesheet -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container d-flex align-items-center justify-content-center">
        
        <div class="card">
            <!-- card header -->
            <div class="card-header">
                <h3 class="text-center">Sign Up</h3>
            </div>
            <!-- card body -->
            <div class="card-body">
                    <form action="" method="POST">
                        <!-- first field -->
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1"><i class="fa fa-user" aria-hidden="true"></i></span>
                            <input type="text" class="form-control" placeholder="Enter your username" required="required" autocomplete="off" name="username"aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                        <!-- second field -->
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1"><i class="fa fa-key" aria-hidden="true"></i></span>
                            <input type="password" class="form-control" placeholder="Enter your password" required="required" autocomplete="off" name="password"aria-label="password" aria-describedby="basic-addon1">
                        </div>
                        <!-- third field -->
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1"><i class="fa fa-lock" aria-hidden="true"></i></span>
                            <input type="password" class="form-control" placeholder="Confirm Password" required="required" autocomplete="off" name="confirm_password"aria-label="confirm_password" aria-describedby="basic-addon1">
                        </div>
                        <!-- Signup btn -->
                        <div class="form-group">
                            <input type="submit" name="register" value="Sign Up" class="btn signup_btn">
                        </div>
                    </form>
            </div>
            <!-- card footer -->
            <div class="card-footer text-center text-light signup">
                Already have an account? <a href="signin.php">Sign In</a>
            </div>
        </div>
    </div>
  
</body>
</html>