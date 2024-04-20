<?php



include './connection/db.php';
// Email validation via AJAX (check_email.php)
if (isset($_GET['email'])) {
   $email = mysqli_real_escape_string($con, $_GET['email']);

   // Check if the email already exists in the database
   $select = mysqli_query($con, "SELECT * FROM `users` WHERE email = '$email'") or die(mysqli_error($con));

   $response = array();
   if (mysqli_num_rows($select) > 0) {
      // Email already exists
      $response['exists'] = true;
   } else {
      // Email is available
      $response['exists'] = false;
   }

   // Send the JSON response
   echo json_encode($response);
}
