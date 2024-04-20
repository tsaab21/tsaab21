<?php 
session_start();
include './admin/connection/config.php';

// Check if user is already logged in
if (isset($_SESSION['user_id'])) {
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
<?php

                              $message = array();

                              if (isset($_POST['submit'])) {
                                 $name = mysqli_real_escape_string($con, $_POST['name']);
                                 $email = mysqli_real_escape_string($con, $_POST['email']);
                                 $password = mysqli_real_escape_string($con, $_POST['password']);
                                 $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);

                                 // Server-side validation
                                 if (empty($name)) {
                                    $message[] = 'Fullname is required.';
                                 }

                                 if (empty($email)) {
                                    $message[] = 'Email is required.';
                                 } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                                    $message[] = 'Please enter a valid email address.';
                                 } elseif (strpos($email, '@gmail.com') === false) {
                                    $message[] = 'Email should be a Gmail address.';
                                 } else {
                                   // Check if the email already exists in the database
                                    // Use a prepared statement to prevent SQL injection
                                    $selectStmt = mysqli_prepare($con, "SELECT * FROM `users` WHERE email = ?");
                                    mysqli_stmt_bind_param($selectStmt, "s", $email);
                                    mysqli_stmt_execute($selectStmt);
                                    $result = mysqli_stmt_get_result($selectStmt);

                                    if (mysqli_num_rows($result) > 0) {
                                       $message[] = 'Email already exists.';
                                    }
                                                               }

                                 if (empty($password)) {
                                    $message[] = 'Password is required.';
                                 } elseif (strlen($password) < 8) {
                                    $message[] = 'Password must be at least 8 characters long.';
                                 } elseif (!preg_match('/[!@#$%^&*()\-_=+{};:,<.>a-zA-Z0-9]+/', $password)) {
                                    $message[] = 'Password must contain at least one special character.';
                                 }

                                 if (empty($cpassword)) {
                                    $message[] = 'Confirm password is required.';
                                 } elseif ($password !== $cpassword) {
                                    $message[] = 'Passwords do not match.';
                                 }

                                 // If there are no validation errors, proceed with registration
                                 if (empty($message)) {
                                    // Hash the password using bcrypt
                                    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                                    // Insert user data into the database
                                    $insert = mysqli_query($con, "INSERT INTO `users` (name, email, password) VALUES ('$name', '$email', '$hashedPassword')") or die(mysqli_error($con));

                                    if ($insert) {
                                       $message[] = 'Registered Successfully';
                                       
                                       // Get the ID of the newly inserted user
                                       $user_id = mysqli_insert_id($con);
                                       
                                       // Redirect to information.php with the user ID as a parameter
                                       header("Location: register.php");
                                       exit();
                                    } else {
                                       $message[] = 'Registration failed';
                                    }
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
    <title>Sign up</title>
    <style>
      .message{
        font-size: 15px;
        background-color: red;
        color: white;
        text-align: center;
      }
    </style>
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
                <?php
                                       if (!empty($message)) {
                                          foreach ($message as $msg) {
                                             echo '<div class="message">' . $msg . '</div>';
                                          }
                                       }
                                       ?>
                   <header>SIGN UP</header>
                  

                   <form id="validate_form" method="post" action="">
                   <div class="input-field">
                        <input type="text" class="input" name="name" id="email" required
                        value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>">
                        <label for="email">Full name</label> 
                    </div> 
                   <div class="input-field">
                        <input type="text" class="input" name="email" id="email" required 
                        value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
                        <label for="email">Email</label> 
                    </div> 
                   <div class="input-field">
                        <input type="password" class="input" id="pass" name="password" required >
                        <label for="pass">Password</label>
                    </div> 
                    <div class="input-field">
                        <input type="password" class="input" id="pass" name="cpassword" required>
                        <label for="pass">Password</label>
                    </div> 
                   <div class="input-field">
                        
                        <input type="submit" class="submit" name="submit" value="Sign in">
                   </div> 
                   </form>
                   <!-- <div class="signin">
                    <span>Forgot<a href="forgot.php"> password?</a></span>
                   </div> -->
                </div>  
            </div>
        </div>
    </div>
</div>
</body>
</html>