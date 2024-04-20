<?php
session_start();
include './admin/connection/config.php';

// Check if user is already logged in
if (isset($_SESSION['user_id'])) {
    $_SESSION['name'] = $row['name'];
    $_SESSION['image'] = $row['image'];

    // Redirect to the appropriate page based on user type
    if ($_SESSION['usertype'] == 'admin') {
        if ($_SESSION['status'] == 'active') {
            header("Location: ./admin/index.php");
            exit;
        } else {
            echo "<script>
                alert('Your account is inactive. Please contact the administrator.');
                window.location.href='login.php';
            </script>";
            exit;
        }
    } elseif ($_SESSION['usertype'] == 'staff') {
        header("Location: ./staff/index.php");
        exit;
    }
}
?>

<?php
if (isset($_POST['submit'])) {
    // check ang mga input mula sa user
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];

    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>
                alert('Please Enter your email');
                window.location.href='login.php';

            </script>";
    }

    if (empty($password)) {
        echo "<script>
        alert('Please Enter your password');
        window.location.href='login.php';

    </script>";    }

    // if walang mga error sa validation, ituloy ang authentication
    if (empty($message)) {
        // query gamit ang prepared statements ( SQL injection)
        $stmt = mysqli_prepare($con, "SELECT * FROM `users` WHERE email = ?");
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);

            // e check kung ang account ay nakalock dahil sa maraming failed login attempts
            $login_attempts = $row['login_attempts'];
            $last_login_attempt = strtotime($row['last_login_attempt']);
            $lockout_duration = min(pow(2, $login_attempts), 3600); //

            if ($login_attempts >= 10 && time() - $last_login_attempt < $lockout_duration) {
                $remaining_time = $lockout_duration - (time() - $last_login_attempt);
                $remaining_minutes = ceil($remaining_time / 60);
                echo "<script>
                alert('Your account is locked due to multiple unsuccessful attempts. Please contact the administrator.');
                window.location.href='login.php';

            </script>";
            } else {
                // e chech ang password gamit ang password_verify()
                if (password_verify($password, $row['password'])) {
                    mysqli_query($con, "UPDATE `users` SET login_attempts = 0, last_login_attempt = NOW() WHERE id = {$row['id']}");
                
                    $_SESSION['user_id'] = $row['id'];
                    $_SESSION['status'] = $row['status'];
                    $_SESSION['usertype'] = $row['usertype'];
                    $_SESSION['name'] = $row['name'];
                    $_SESSION['image'] = $row['image'];

                    // Insert activity log
                    $actionDescription = "logged in using $email";
                    $insertLogQuery = "INSERT INTO activity_log (user_id, usertype, action_description) VALUES (?, ?, ?)";
                    $stmt = mysqli_prepare($con, $insertLogQuery);
                    mysqli_stmt_bind_param($stmt, "iss", $row['id'], $_SESSION['usertype'], $actionDescription);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_close($stmt);
                    // Suriin ang status ng user ayon sa user type
                    if ($_SESSION['usertype'] == 'admin') {
                        if ($_SESSION['status'] == 'active') {
                            header("Location: ./admin/index.php");
                            exit;
                        } else {
                            echo "<script>
                                alert('Your account is inactive. Please contact the administrator.');
                                window.location.href='login.php';
                            </script>";
                            exit;
                        }
                    } elseif ($_SESSION['usertype'] == 'staff') {
                        header("Location: ./staff/index.php");
                        exit;
                       
                    } else {
                        echo "<script>
                        alert('Wrong Email or Password, try again');
                        window.location.href='login.php';
                    </script>";            
                        }
                } else {
                    // Maling password na ibinigay
                    // Dagdagan ang login attempts at i-update ang last_login_attempt timestamp
                    mysqli_query($con, "UPDATE `users` SET login_attempts = login_attempts + 1, last_login_attempt = NOW() WHERE id = {$row['id']}");
                    $remaining_attempts = 10 - ($login_attempts + 1);
                    if ($remaining_attempts > 0) {
                        echo "<script>
                        alert('Invalid email or password. {$remaining_attempts} more attempt will lock your account permanently');
                        window.location.href='login.php';
                    </script>";
                    } else {
                        echo "<script>
                        alert('Your account is locked due to multiple unsuccessful attempts. Please contact the administrator');
                        window.location.href='login.php';
                    </script>";
                    }
                }
            }
        } else {
            echo "<script>
            alert('Wrong Email or Password, try again');
            window.location.href='login.php';
        </script>";
            }
    }
}

// inser farmers modal
$msg = "";
// profiling
if (isset($_POST['submit_agri_farm'])) {
    $surname = mysqli_real_escape_string($con, $_POST['surname']);
    $firstname = mysqli_real_escape_string($con, $_POST['firstname']);
    $middlename = mysqli_real_escape_string($con, $_POST['middlename']);
    $sex = mysqli_real_escape_string($con, $_POST['sex']);
    $cstatus = mysqli_real_escape_string($con, $_POST['cstatus']);
    $cnumber = mysqli_real_escape_string($con, $_POST['cnumber']);
    $bldg = mysqli_real_escape_string($con, $_POST['bldg']);
    $sitio = mysqli_real_escape_string($con, $_POST['sitio']);
    $barangay = mysqli_real_escape_string($con, $_POST['barangay']);
    $municipality = mysqli_real_escape_string($con, $_POST['municipality']);
    $province = mysqli_real_escape_string($con, $_POST['province']);
    $region = mysqli_real_escape_string($con, $_POST['region']);
    $birthday = mysqli_real_escape_string($con, $_POST['birthday']);
    $placeofbirth = mysqli_real_escape_string($con, $_POST['placeofbirth']);
    $education = mysqli_real_escape_string($con, $_POST['education']);
    $religion = mysqli_real_escape_string($con, $_POST['religion']);
    $isdisability = mysqli_real_escape_string($con, $_POST['isdisability']);
    $is4ps = mysqli_real_escape_string($con, $_POST['is4ps']);
    $isindigenous = mysqli_real_escape_string($con, $_POST['isindigenous']);
    $valid_id = mysqli_real_escape_string($con, $_POST['valid_id']);
    $ishousehead = mysqli_real_escape_string($con, $_POST['ishousehead']);
    $land_address = mysqli_real_escape_string($con, $_POST['land_address']);
    $land_status = mysqli_real_escape_string($con, $_POST['land_status']);
    $land_area = mysqli_real_escape_string($con, $_POST['land_area']);
    $farming_activity = mysqli_real_escape_string($con, $_POST['farming_activity']);
    $production_income = mysqli_real_escape_string($con, $_POST['production_income']);
    $income_nonfarming = mysqli_real_escape_string($con, $_POST['income_nonfarming']);
    $farming_status = mysqli_real_escape_string($con, $_POST['farming_status']);


    $msg = "";
	$image = $_FILES['image']['name'];
	$target = "./admin/upload_images/".basename($image);

	if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
  		$msg = "Image uploaded successfully";
  	}else{
  		$msg = "Failed to upload image";
  	}

      $check_query = mysqli_query($con, "SELECT * FROM `agri_farmers` WHERE `surname` = '$surname' AND `firstname` = '$firstname' AND `middlename` = '$middlename'");

      if (mysqli_num_rows($check_query) > 0) {
          // If a record with the same complete name exists, you can choose to update it or display an error message
          echo "<script>
          alert('Your name already exist, please try another');
          window.location.href='index.php';
          </script>";    
          } else {
          // If no record with the same complete name exists, proceed with the insertion
          $agri_farm = mysqli_query($con, "INSERT INTO `agri_farmers` ( `surname`, `firstname`, `middlename`, `sex`, 
              `cstatus`, `cnumber`, `bldg`, `sitio`, `barangay`, `municipality`, `province`, `region`, `birthday`,
              `placeofbirth`, `education`, `religion`, `isdisability`, `is4ps`, `isindigenous`, `valid_id`, 
              `ishousehead`, `land_address`, `land_status`, `land_area`, `farming_activity`, `production_income`, `income_nonfarming`, `image`, `farming_status`)
              VALUES ('$surname','$firstname','$middlename','$sex','$cstatus','$cnumber','$bldg',
              '$sitio','$barangay','$municipality','$province','$region','$birthday','$placeofbirth',
              '$education','$religion','$isdisability','$is4ps','$isindigenous','$valid_id','$ishousehead',
              '$land_address','$land_status','$land_area','$farming_activity','$production_income','$income_nonfarming','$image','$farming_status')") or die(mysqli_error($con));
  
          if ($agri_farm) {
              $inserted_id = mysqli_insert_id($con); // Get the inserted ID
             
              $notification_message = "New "  . $farming_status;
              $notification_link = "http://localhost/Abdulwaris-Lidasan-Sabidin-v2/admin/profile.php?farmer_id=".$inserted_id; // Assuming you have a page to view supply details
              $notification_sql = "INSERT INTO `notifications`(`message`, `link`) VALUES ('$notification_message', '$notification_link')";
              mysqli_query($con, $notification_sql);
          
              echo "<script>
              alert('Success! Another transaction, please!');
              window.location.href='print.php?id=$inserted_id';
              </script>";
          } else {
              echo "Data not inserted";
          }
      }
  }
  ?>