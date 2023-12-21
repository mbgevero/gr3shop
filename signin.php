<?php
session_start();
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        require_once("db.php"); // Include your database connection file

        $enteredUsername = $_POST["username"];
        $enteredPassword = $_POST["password"];

        $storedHashedPassword = getHashedPasswordFromDatabase($enteredUsername);

        if ($storedHashedPassword && password_verify($enteredPassword, $storedHashedPassword)) {

            $_SESSION["username"] = $enteredUsername;

            header("Location: home.php");
            exit(); // Ensure that no more content is sent to the browser after the header
        } else {
            echo "<script>alert('Invalid username or password');</script>";
        }
    }

    function getHashedPasswordFromDatabase($username) {
        // Replace the following lines with your actual database connection and query
        $conn = mysqli_connect("localhost", "root", "", "registration");

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $username = mysqli_real_escape_string($conn, $username);
        $query = "SELECT password FROM user_data WHERE username = '$username'";
        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            return $row["password"];
        }

        mysqli_close($conn);

        return false;
    }
    ?>

    <!-- Include Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-rqPqPd/R6D7G2vDg9i/Q89G2f4NR7nuIf2ElCqauMOzK7e4U6n7fmhQMWa2W4d1F" crossorigin="anonymous"></script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>

    <!-- bootstrap css link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!--  font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- stylesheet -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container d-flex align-items-center justify-content-center">
        <div class="card signin_card">
            <!-- card header -->
            <div class="card-header">
                <h3 class="text-center">Sign In</h3>
            </div>
            <!-- card body -->
            <div class="card-body">
                    <form method="post" action="">
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

                        <!-- Signup btn -->
                        <div class="form-group">
                            <input type="submit" name="register" value="Sign In" class="btn_registration_btn">
                        </div>
                    </form>
            </div>
            <!-- card footer -->
            <div class="card-footer text-center text-light signin">
               Don't have an account? <a href="index.php">Sign Up</a>
            </div>
        </div>
    </div>
  
</body>
</html>