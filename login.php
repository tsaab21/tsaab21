<?php 
session_start();
include './admin/connection/config.php';

// Check if user is already logged in
if (isset($_SESSION['user_id'])) {
    // Check user's status here
    if ($_SESSION['status'] === 'inactive') {
        session_destroy(); // Destroy the session
    }

    // Redirect to the appropriate page based on user type
    if ($_SESSION['usertype'] == 'admin') {
        header("Location: ./admin/index.php");
        exit;
    } elseif ($_SESSION['usertype'] == 'staff') {
        header("Location: ./staff/index.php"); // You can replace this with the actual path for the user dashboard
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Login</title>
</head>
<body>
  <div class="wrapper">
    <div class="container main">
        <div class="row">
            <div class="col-md-6 side-image">
           
                  <div class="text">
                </div>
            </div>
            <div class="col-md-6 right">
                
                <div class="input-box">
                   
                   <header>SIGN IN</header>
                   <form id="validate_form" method="post" action="code.php">
                   <div class="input-field">
                        <input type="text" class="input" name="email" id="email" required>
                        <label for="email">Email</label> 
                    </div> 
                   <div class="input-field">
                        <input type="password" class="input" id="pass" name="password" required>
                        <label for="pass">Password</label>
                    </div> 
                   <div class="input-field">
                        
                        <input type="submit" class="submit" name="submit" value="Sign in">
                   </div> 
                   </form>
                   <div class="signin">
                    <span>Forgot<a href="forgot"> password?</a></span>
                   </div>
                   <!-- <div class="signin">
                    <span>Don't have an<a href="forgot.php"> password?</a></span>
                   </div> -->
                </div>  
            </div>
        </div>
    </div>
</div>
</body>
</html>