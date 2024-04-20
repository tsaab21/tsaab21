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
$error = array();
include './admin/connection/config.php';
require "./admin/mail.php";
$mode = "enter_email";
if (isset($_GET['mode'])) {
	$mode = $_GET['mode'];
}

//something is posted
if (count($_POST) > 0) {

	switch ($mode) {
		case 'enter_email':
			// code...
			$email = $_POST['email'];
			//validate email
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$error[] = "Please enter a valid email";
			} elseif (!valid_email($email)) {
				$error[] = "That email was not found";
			} else {

				$_SESSION['forgot']['email'] = $email;
				send_email($email);
				header("Location: forgot.php?mode=enter_code");
				die;
			}
			break;

		case 'enter_code':
			// code...
			$code = $_POST['code'];
			$result = is_code_correct($code);

			if ($result == "the code is correct") {

				$_SESSION['forgot']['code'] = $code;
				header("Location: forgot.php?mode=enter_password");
				die;
			} else {
				$error[] = $result;
			}
			break;

		case 'enter_password':
			// code...
			$password = $_POST['password'];
			$password2 = $_POST['password2'];

			if ($password !== $password2) {
				$error[] = "Passwords do not match";
			} elseif (!isset($_SESSION['forgot']['email']) || !isset($_SESSION['forgot']['code'])) {
				header("Location: forgot.php");
				die;
			} else {

				save_password($password);
				if (isset($_SESSION['forgot'])) {
					unset($_SESSION['forgot']);
				}

				header("Location: login.php");
				die;
			}
			break;

		default:
			// code...
			break;
	}
}

function send_email($email)
{
	global $con;

	$expire = time() + (60 * 3);
	$code = rand(10000, 99999);
	$email = addslashes($email);

	// Fetch user's name from the database using the provided email
	$query = "SELECT name FROM users WHERE email = '$email' LIMIT 1";
	$result = mysqli_query($con, $query);

	if ($result && mysqli_num_rows($result) > 0) {
		$row = mysqli_fetch_assoc($result);
		$name = $row['name'];

		// Create the email message
		$message = "
        <!DOCTYPE html>
        <html>
        <head>
            <title>Password Reset</title>
        </head>
        <body>
            <table cellpadding='0' cellspacing='0' width='100%' style='background-color: #f4f4f4;'>
                <tr>
                    <td align='center'>
                        <table cellpadding='0' cellspacing='0' width='600' style='background-color: #ffffff; margin-top: 20px;'>
                            <tr>
                                <td style='padding: 20px;'>
                                    <img src='https://th.bing.com/th/id/OIP.m9V5Xhq8sYKYrK_9Gc6LLwHaHa?pid=ImgDet&rs=1' alt='Logo' style='width: 40%; max-width: 60px'>
                                    <h3> <span style='color: green; font-weight: bold;'>Password Reset</span></h3>
                                    <p>Hi <span style='font-weight: bold;'> $name!,</span></p>
                                    <p>You've requested a password reset for your account.</p>
                                    <p>Your verification code is: <strong>$code</strong></p>
                                    <p>If you didn't initiate this request, you can safely ignore this email. Your password will remain unchanged.</p>
                                    <p>Best regards,<br>The Agri-web Team</p>
									
									<pMatanog Maguindanao Del Norte,<br>
									This message was sent to $email .
									To help keep your account secure, please don't forward this email. <a href='google.com'>Learn more</a></p>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </body>
        </html>
        ";

		// Send the HTML email
		send_mail(
			$email,
			'Password Reset',
			$message
		);

		// Insert code into the database
		$query = "INSERT INTO codes (email, code, expire) VALUES ('$email', '$code', '$expire')";
		mysqli_query($con, $query);
	}

}
function save_password($password)
{
	global $con;

	$password = password_hash($password, PASSWORD_BCRYPT);
	$email = addslashes($_SESSION['forgot']['email']);

	// Fetch user's name from the database
	$name = get_user_name($email);

	$query = "update users set password = '$password' where email = '$email' limit 1";
	mysqli_query($con, $query);

	// Send email notification for password change
	send_password_change_notification($email, $name);

	// Unset the 'forgot' session data
	if (isset($_SESSION['forgot'])) {
		unset($_SESSION['forgot']);
	}
}

// get username
function get_user_name($email)
{
	global $con;

	$email = addslashes($email);

	$query = "SELECT name FROM users WHERE email = '$email' LIMIT 1";
	$result = mysqli_query($con, $query);

	if ($result && mysqli_num_rows($result) > 0) {
		$row = mysqli_fetch_assoc($result);
		return $row['name'];
	}

	return '';
}


// notification
function send_password_change_notification($email, $name)
{
	// You can customize the subject and content of the email notification here
	$subject = 'Password Changed';
	$message = "<!DOCTYPE html>
	<html>
	<head>
		<title>Password Changed</title>
	</head>
	<body>
		<table cellpadding='0' cellspacing='0' width='100%' style='background-color: #f4f4f4;'>
			<tr>
				<td align='center'>
					<table cellpadding='0' cellspacing='0' width='600' style='background-color: #ffffff; margin-top: 20px;'>
						<tr>
							<td style='padding: 20px;'>
								<img src='https://th.bing.com/th/id/OIP.m9V5Xhq8sYKYrK_9Gc6LLwHaHa?pid=ImgDet&rs=1' alt='Logo' style='width: 40%; max-width: 60px'>
								<h3> <span style='color: red; font-weight: bold;'>Password Reset</span></h3>
								<p>Hi <span style='font-weight: bold;'> $name!,</span></p>
								<p>Your password for your account has been successfully changed.
								 If you didn't make this change, please contact our customer servic
								 e team immediately at <a>techagrisupport@gmail.com</a>.</p>
								<p>Best regards,<br>The Agri-web Team</p>
								
								<pMatanog Maguindanao Del Norte,<br>
								This message was sent to $email .
								To help keep your account secure, please don't forward this email. <a href='google.com'>Learn more</a></p>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</body>
	</html>
	";

	// Send email notification
	send_mail($email, $subject, $message);
}

function valid_email($email)
{
	global $con;

	$email = addslashes($email);

	$query = "select * from users where email = '$email' limit 1";
	$result = mysqli_query($con, $query);
	if ($result) {
		if (mysqli_num_rows($result) > 0) {
			return true;
		}
	}

	return false;

}

function is_code_correct($code)
{
	global $con;

	$code = addslashes($code);
	$expire = time();
	$email = addslashes($_SESSION['forgot']['email']);

	$query = "select * from codes where code = '$code' && email = '$email' order by id desc limit 1";
	$result = mysqli_query($con, $query);
	if ($result) {
		if (mysqli_num_rows($result) > 0) {
			$row = mysqli_fetch_assoc($result);
			if ($row['expire'] > $expire) {

				return "the code is correct";
			} else {
				return "the code is expired";
			}
		} else {
			return "the code is incorrect";
		}
	}

	return "the code is incorrect";
}


?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/login.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
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


						<?php

						switch ($mode) {
							case 'enter_email':
								// code...
								?>
								<form method="post" action="forgot.php?mode=enter_email">
									<header>FORGOT PASSWORD</header>
									<?php
									foreach ($error as $err) {
										// code...
										echo $err . "<br>";
									}
									?>
									<div class="input-field">
										<input type="text" class="input" name="email" id="email" required>
										<label for="email">Email</label>
									</div>
									<div class="input-field">

										<input type="submit" class="submit" value="submit">
									</div>
									<div class="signin">
										<span>Sign<a href="login.php"> in?</a></span>
									</div>
								</form>
								<?php
								break;

							case 'enter_code':
								// code...
								?>
								<div class="form-container">
									<form method="post" action="forgot.php?mode=enter_code">
										<header>Verification Code</header>
										<?php
										foreach ($error as $err) {
											// code...
											echo $err . "<br>";
										}
										?>
										<div class="input-field">
											<input type="text" class="input" name="code" id="email"
												placeholder="Check your email for Verification code">
											<label for="email">Verification Code</label>
										</div>
										<div class="input-field">
											<input type="submit" class="submit" value="Next">
										</div>
										<div class="signin">
											<span>Enter email<a href="forgot.php"> again?</a></span>
										</div>
										<!-- <div class="signin">
					<span>Login<a href="login.php"> Now?</a></span>
				   </div> -->
									</form>
									<?php
									break;

							case 'enter_password':
								// code...
								?>
									<div class="form-container">
										<form method="post" action="forgot.php?mode=enter_password">
											<header>Create new password</header>
											<?php
											foreach ($error as $err) {
												// code...
												echo $err . "<br>";
											}
											?>
											<div class="input-field">
												<input ttype="password" class="input" name="password" id="email"
												placeholder="Enter new password">
												<label for="email">New Password</label>
											</div>
											<div class="input-field">
												<input ttype="password" class="input" name="password2" id="email2"
												placeholder="Confirm your Password">
												<label for="email">Confirm Password</label>
											</div>
											<div class="input-field">
											<input type="submit" class="submit" value="Submit">
										</div>
														<div class="signin">
													<span>Login<a href="login"> Now?</a></span>
												</div>

										</form>
										<?php
										break;

							default:
								// code...
								break;
						}

						?>
</div>
                </div>  
            </div>
        </div>
    </div>
</div>
</body>
</html>