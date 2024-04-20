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
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Print</title>
  <!-- Bootstrap CSS CDN -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

  <!-- Our Custom CSS -->
  <link rel="stylesheet" href="css/print.css" />
  <!-- Font Awesome JS -->
  <style>
    .information-cell {
      text-align: center;
    }

    .text-center p {
      font-size: 12px;
      text-align: center;
    }

    /* .signature-container {
      text-align: center;
    }

    .signature {
      display: inline-block;
      margin: 0 20px;
      /* Magdagdag ng spacing sa magkabilang side */
    }

    .signature p {
      margin: 0;
      /* Alisin ang default margin ng <p> */
      position: relative;
      display: inline;
      /* Baguhin ang display value para magkasama ang mga pangalan */
    }

    .signature p.baranggay {
      position: relative;
    }

    .signature p.baranggay::before {
      content: "";
      position: absolute;
      bottom: -5px;
      left: 0;
      right: 0;
      border-bottom: 1px solid black;
    } */

    .buttons-container {
      text-align: right;
      margin-top: 20px;
      /* Add some margin for spacing */
    }

    .divider {
      width: 100%;
      height: 1px;
      background-color: red;
    }

    .text-justify {
      text-align: justify;
    }
    .text-justify {
  font-size: 12px;
  background-color: #f0f0f0; 
  color: #333;
}

  </style>
</head>

<body>
  <div class="wrapper">
    <!-- Sidebar Holder -->
    <!-- Page Content Holder -->
    <div id="content">
      <div class="container">
        <div class="row">
          <div class="buttons-container d-flex justify-content-center mt-3">
          <button id="myButton" class="btn btn-danger me-2">
  <i class="bi bi-chevron-left"></i> Back
</button>
            <button id="print" class="btn btn-secondary">
              <i class="bi bi-printer"></i> Print
            </button>
          </div>
          <a id="save_to_image">
            <div class="invoice-container">
              <table cellpadding="0" cellspacing="0">
                <tr class="top">
                  <td colspan="2">
                    <table>
                      <tr>
                        <td class="title">
                        <?php
                          $query = "SELECT left_side_logo FROM system_management";

                          $result = mysqli_query($con, $query);

                          if ($result) {
                            // Check if there are matching records
                            if (mysqli_num_rows($result) > 0) {
                              while ($row = mysqli_fetch_assoc($result)) {
                                // Access and output each 'right_side_logo' value as an image source
                                $left_side_logo = $row['left_side_logo'];
                                echo '<img src="./admin/' . $left_side_logo . '" style="width: 150%; max-width: 120px" />' . "<br>";
                              }
                            } else {
                              echo "No matching records found.";
                            }
                            mysqli_free_result($result);
                          } else {
                            echo "Error executing the query: " . mysqli_error($con);
                          }

                          ?>
                        </td>
                        <td class="text-center">
                          <p>
                            Republic Of the Phillipines<br />
                            <strong> <span style="color: green; font-weight: bold;">Bangsamoro Autonomous Region in
                                Muslim Mindanao</span></strong><br />
                            <strong><span style="color: red; font-weight: bold;"> Ministry of Agriculture, Fisheries and
                                Agrarian Reform</span></strong><br />
                            <span style="font-weight: bold;"> Province Of Maguindanao Del Norte</span><br />
                            <strong>Municipality of Matanog</strong><br />

                          </p>
                        </td>
                        <td class="title">
                        <?php
                          $query = "SELECT right_side_logo FROM system_management";

                          $result = mysqli_query($con, $query);

                          if ($result) {
                            // Check if there are matching records
                            if (mysqli_num_rows($result) > 0) {
                              while ($row = mysqli_fetch_assoc($result)) {
                                // Access and output each 'right_side_logo' value as an image source
                                $right_side_logo = $row['right_side_logo'];
                                echo '<img src="./admin/' . $right_side_logo . '" style="width: 150%; max-width: 120px" />' . "<br>";
                              }
                            } else {
                              echo "No matching records found.";
                            }
                            mysqli_free_result($result);
                          } else {
                            echo "Error executing the query: " . mysqli_error($con);
                          }

                          ?>                        </td>
                      </tr>
                    </table>
                    <div class="divider"></div>
                    <br>
                    <h3 class="text-center"><span style="color: green; font-weight: bold;">PROOF OF REGISTRATION</span>
                    </h3>

                  </td>
                </tr>

                <?php
                if (isset($_GET['id'])) {
                  $record_id = $_GET['id'];
                  $safe_record_id = mysqli_real_escape_string($con, $record_id);

                  // Fetch the associated record from the database
                  $query = "SELECT * FROM `agri_farmers` WHERE `id` = '$safe_record_id'";
                  // Debugging: Display the SQL query
                  // echo "SQL Query: " . $query . "<br>";
                
                  $result = mysqli_query($con, $query);

                  if ($result && mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
                    ?>

                    <tr class="heading">
                      <td>Basic Information</td>
                      <td></td>
                    </tr>
                    <tr class="item">
                      <td>Name:</td>
                      <td>
                        <?php echo $row['surname'] . ', ' . $row['firstname'] . ' ' . $row['middlename']; ?>
                      </td>
                    </tr>
                    <tr class="item">
                      <td>Registration NO.:</td>
                      <td>
                        <?php echo $row['id']; ?>
                      </td>
                    </tr>
                    <tr class="item last">
                      <td>Address:</td>
                      <td>
                        <?php echo $row['sitio'] . ' ' . $row['barangay'] . ' ' . $row['municipality'] . ' ' . $row['province']; ?>
                      </td>
                    </tr>
                    </tr>
                    <tr class="item">
                      <td>Type of Farming Sector</td>
                      <td>
                        <?php echo $row['farming_status']; ?>
                      </td>
                    </tr>
                    <tr class="item">
                      <td>Date Registered</td>
                      <td>
                        <?php
                        $dateFromDatabase = $row['date']; // Assuming $row['date'] contains the date from the database
                    
                        $formattedDate = date("F j, Y", strtotime($dateFromDatabase));
                        echo $formattedDate;
                        ?>
                      </td>
                    </tr>
                    <?php
                  } else {
                    echo "No record found for the given ID";
                  }
                } else {
                  echo "ID not provided";
                }
                ?>
              </table>
              <br>
              <h5 class="baranggay"><span style="color: red; font-weight: bold;">Notice:</span></h5>
              <p>We have received your information, and our team is currently verifying the details you have submitted.
                 Please wait for a few hours to receive a notification from our office,
                  which should not be less than 72 hours or equivalent to three days.
                   In case you do not receive an SMS notification from us, please contact our office."</p>
              <div class="signature-container">
                <div class="signature">

                </div>

              </div>
            
              <div class="data-privacy">
              <h6 class="text text-danger text-center">
                <strong style="font-weight: bold;">DATA PRIVACY POLICY</strong>
              </h6>
              <p class="text-justify">By submitting your personal information, you consent to its collection,
                processing, and storage in accordance with our Data Privacy Policy. Your data's security and
                confidentiality are
                our top priorities. Please be aware that modifying this information may require specific documents and
                processes.
                Your data may also be used for future supply provisions.</p>
                </div>
            <img src="./admin/upload_images/qr.png" style="width: 150%; max-width: 120px" />
            </div>

        </div>


      </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <script src="included/scripts.js"></script>
    <script src="js/html2canvas.js"></script>
    <script src="print.js"></script>
    <script>
  document.getElementById("myButton").addEventListener("click", function() {
    window.location.href = "index.php";
  });
</script>
</body>

</html>