<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device=width, initial-scale=1.0">
    <title>The Activities</title>
    <link rel="stylesheet" href="category-css/bootstrap.min.css">
    <link rel="stylesheet" href="category-css/style.css">
    <link rel="stylesheet" href="css/mainpage.css">

<script src="js/bootstrap.bundle.min.js"></script>

</head>
<style>
    .sign {
        color: white;
        background-color: green;
        width: 150px;
        height: 40px;
        border-radius: 5px; /* Add a border-radius to round the corners */
        transition: background-color 0.3s, color 0.3s, border-radius 0.3s; /* Add a smooth transition */
    }

    .sign:hover {
        background-color: white;
        color: green;
        border-radius: 5px; /* Adjust the border-radius on hover */
    }
    .another {
    color: black;
    background-color: rgba(255, 255, 255, 0); /* Transparent white background */
    width: 80px;
    height: 40px;
    border: none;
    border-radius: 5px;
    transition: background-color 0.3s, color 0.3s, border-radius 0.3s;
}


    .another:hover {
        background-color: green;
        color: white;
        border-radius: 5px; /* Adjust the border-radius on hover */
    }

    /* modal */
    .modal-img {
        max-width: 90%; /* Adjust the maximum width as needed */
        max-height: 80vh; /* Adjust the maximum height as needed */
        margin: 0 auto; /* Center the image horizontally */
        display: block;
    }
</style>
<body>


<nav class="navbar navbar-expand-lg navbar-light bg-warning fixed-top">
  <div class="container">
    <a class="navbar-brand" href="#"><span class="text-danger">AGRI</span> MATANOG</a>
    <button class="navbar-toggler btn-danger" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon btn btn-danger"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="index.php#services"><button class="another">Home</button></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="index.php#about"><button class="another">About</button></a>
        </li>


        <li class="nav-item">
          <a class="nav-link" href="index.php#team"><button class="another">Team</button></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="category.php"><button class="another">Gallery</button></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="index.php#map"><button class="another">Map</button></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="index.php#contactinfo"><button class="another">Contact</button></a>
        </li>
       
        <li class="nav-item">
          <a class="nav-link" href="index.php#contact"><button class="another">Feedback</button></a>
        </li>
        
        <li class="nav-item">
          <a class="nav-link" href="login.php">
            <button class="sign">Signin</button>
          </a>
        </li>

      </ul>
    </div>
  </div>
</nav>


<!-- Modal -->
<div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    <img id="modalImage" src="" alt="Enlarged Image" class="modal-img">
                </div>
                <div class="modal-footer">
                <!-- Add a button or link to go back to categories.php -->
                <a href="category.php" class="btn btn-warning">Close</a>
            </div>
            </div>
        </div>
    </div>



<div class="container main-news">
    <div class="row">
        <div class="col-8">
            <div class="mb-4 mt-4 section">
				<br><br>
                <div class="section-title">
                    <span>MAFAR ACTIVITIES</span>
                </div>

				<?php
include './admin/connection/config.php';


$sql = "SELECT * FROM main_page";
$result = mysqli_query($con, $sql);

while ($row = mysqli_fetch_assoc($result)) {
    // I-moves ang pagkuha ng petsa dito, pagkatapos ng pagkuha ng $row mula sa database
    $dateString = $row['date']; // Kunin ang petsa mula sa $row array
    $dateObj = new DateTime($dateString);
    $formattedDate = $dateObj->format('F j, Y');

    echo '<div class="row mb-3 bb-1 pt-0">';
    echo '<div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">';
    echo '<img src="./admin/upload_images/' . $row['image'] . '" width="200" height="200" data-toggle="modal" data-target="#imageModal" data-image="./admin/upload_images/' . $row['image'] . '">';
    echo '</div>';
    echo '<div class="col-md-8 col-lg-8 col-sm-12 col-xs-12">';
    echo '<h2 class="summary pt-3 text-success">' . $row['title'] . '</h2>';
    echo '<h6 class="summary pt-3">' . $formattedDate . '</h6>';
    
    $message = $row['message'];
    $messageWords = explode(' ', $message);
    $messageCount = count($messageWords);
    $maxLength = 50;
    
    if ($messageCount > $maxLength) {
        $shortenedMessage = implode(' ', array_slice($messageWords, 0, $maxLength));
        echo '<div class="message-container">';
        echo '<p class="summary pt-3 truncated-message text-dark" style="text-align: justify;">' . $shortenedMessage . ' <a href="#" class="read-more-link">Read More</a></p>';
		echo '<p class="full-message text-dark" style="display: none; text-align: justify;">' . $message . '</p>';
        echo '</div>';
    } else {
        echo '<p class="summary pt-3 text-dark">' . $message . '</p>';
    }

    echo '</div>';
    echo '</div>';
    echo '<hr>'; // Add a horizontal line as a separator between entries.
}
mysqli_close($con);
?>




            </div>
        </div>
        <div class="col-4">
            <div class="trending mt-4">
			<br><br>

                <div class="section-title">
                    <span>Infographic Videos</span>
                </div>
				<div class="row">
                    <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
                    <a href="https://youtu.be/b0c1Huoty_Y?si=_1ZkBbgRiDDaaUfa" style="text-decoration: none; color: black;">
                      <img class="thumb" src="admin/upload_images/saging.jpg">
                    </div>
                    <div class="col-md-8 col-lg-8 col-sm-12 col-xs-12">
                    
    Paanu magtanim ng saging? <br>
    Please watch the Full Video.
</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
                    <a href="https://youtu.be/b0c1Huoty_Y?si=_1ZkBbgRiDDaaUfa" style="text-decoration: none; color: black;">
                      <img class="thumb" src="admin/upload_images/saging.jpg">
                    </div>
                    <div class="col-md-8 col-lg-8 col-sm-12 col-xs-12">
                    
    Paanu magtanim ng saging? <br>
    Please watch the Full Video.
</a>
                    </div>
            </div>
        </div>
    </div>
</div>
<link rel="stylesheet" href="category-css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script>
        $(document).ready(function () {
            $("img[data-toggle='modal']").click(function () {
                var imageSrc = $(this).data("image");
                $("#modalImage").attr("src", imageSrc);
                $("#imageModal").modal("show");
            });
        });

        $(document).ready(function () {
            $(".read-more-link").click(function (e) {
                e.preventDefault();
                var $messageContainer = $(this).closest('.message-container');
                var $truncatedMessage = $messageContainer.find('.truncated-message');
                var $fullMessage = $messageContainer.find('.full-message');
                if ($truncatedMessage.is(":visible")) {
                    $truncatedMessage.hide();
                    $fullMessage.show();
                    $(this).text("Read Less");
                } else {
                    $truncatedMessage.show();
                    $fullMessage.hide();
                    $(this).text("Read More");
                }
            });
        });
    </script>
        <script>
  (function (w, d, s, o, f, js, fjs) {
    w["botsonic_widget"] = o;
    w[o] =
      w[o] ||
      function () {
        (w[o].q = w[o].q || []).push(arguments);
      };
    (js = d.createElement(s)), (fjs = d.getElementsByTagName(s)[0]);
    js.id = o;
    js.src = f;
    js.async = 1;
    fjs.parentNode.insertBefore(js, fjs);
  })(window, document, "script", "Botsonic", "https://widget.writesonic.com/CDN/botsonic.min.js");
  Botsonic("init", {
    serviceBaseUrl: "https://api.botsonic.ai",
    token: "7322400d-66c5-4807-8eb4-4300a737f800",
  });
</script>


</body>
</html>
