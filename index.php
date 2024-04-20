<?php
session_start();
include './admin/connection/config.php';
if (isset($_SESSION['user_id'])) {
    if ($_SESSION['usertype'] == 'admin') {
        header("Location: ./admin/index.php");
        exit;
    } elseif ($_SESSION['usertype'] == 'staff') {
        header("Location: ./staff/index.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tsaab</title>
    <!-- chatbot -->

    <!-- All CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/mainpage.css">
    <style>
        .contact-box {
            border: 1px solid #ccc;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <?php include "header.php" ?>
    <?php include "farmers_modal.php" ?>
    <section class="services section-padding" id="services">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-header text-center pb-5">
                        <h2 class="text text-danger"><span style="font-weight: bold;">REGISTRATION FORM</span></h2>
                        <h4>RSBSA FORM</h4>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center align-items-center">
                <div class="col-12 col-md-12 col-lg-4">
                    <div class="card text-white text-center bg-success pb-2" style="height: 400px;">
                        <div class="card-body">
                            <i class="bi bi-laptop"></i>
                            <h3 class="card-title">FARMERS REGISTRATION FORM</h3>
                            <p class="lead">This form is intended for farmers only, please provide the correct
                                information.</p>
                            <?php
                            include './admin/connection/config.php';

                            $sqlFormStatus = "SELECT status FROM manage_forms WHERE form_name = 'REGISTRATION FOR FARMERS'";
                            $resultFormStatus = mysqli_query($con, $sqlFormStatus);

                            $buttonText = "Register Now";
                            $buttonDisabled = false;

                            if ($resultFormStatus) {
                                if (mysqli_num_rows($resultFormStatus) > 0) {
                                    $rowFormStatus = mysqli_fetch_assoc($resultFormStatus);
                                    $formStatus = $rowFormStatus['status'];

                                    if ($formStatus == 'inactive') {
                                        $buttonText = "Closed";
                                        $buttonDisabled = true;
                                    }
                                }
                            }
                            ?>
                            <?php if (!$buttonDisabled): ?>
                                <button class="btn bg-warning text-white" data-bs-toggle="modal"
                                    data-bs-target="#portfolioModal">
                                    <?php echo $buttonText; ?>
                                </button>
                            <?php else: ?>
                                <button class="btn bg-warning text-white" disabled>
                                    <?php echo $buttonText; ?>
                                </button>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-12 col-lg-4">
                    <div class="card text-white text-center bg-success pb-2" style="height: 400px;">
                        <div class="card-body">
                            <i class="bi bi-laptop"></i>
                            <h3 class="card-title">FISHERIES REGISTRATION FORM</h3>
                            <p class="lead">This form is intended for fisheries only, please provide the correct
                                information.</p>
                            <?php
                            include './admin/connection/config.php';

                            $sqlFormStatus = "SELECT status FROM manage_forms WHERE form_name = 'REGISTRATION FOR FISHERFOLKS'";
                            $resultFormStatus = mysqli_query($con, $sqlFormStatus);

                            $buttonText = "Register Now";
                            $buttonDisabled = false;

                            if ($resultFormStatus) {
                                if (mysqli_num_rows($resultFormStatus) > 0) {
                                    $rowFormStatus = mysqli_fetch_assoc($resultFormStatus);
                                    $formStatus = $rowFormStatus['status'];
                                    if ($formStatus == 'inactive') {
                                        $buttonText = "Closed";
                                        $buttonDisabled = true;
                                    }
                                }
                            }
                            ?>
                            <?php if (!$buttonDisabled): ?>
                                <button class="btn bg-warning text-dark" data-bs-toggle="modal"
                                    data-bs-target="#portfolioModal">
                                    <?php echo $buttonText; ?>
                                </button>
                            <?php else: ?>
                                <button class="btn bg-warning text-white" disabled>
                                    <?php echo $buttonText; ?>
                                </button>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-12 col-lg-4">
                    <div class="card text-white text-center bg-success pb-2" style="height: 400px;">
                        <div class="card-body">
                            <i class="bi bi-laptop"></i>
                            <h3 class="card-title">REGISTRATION FORM FOR USERS</h3>
                            <p class="lead">This form is for applicant only, please provide the correct information.</p>
                            <?php
                            include './admin/connection/config.php';

                            $sqlFormStatus = "SELECT status FROM manage_forms WHERE form_name = 'USERS'";
                            $resultFormStatus = mysqli_query($con, $sqlFormStatus);

                            $buttonText = "Register Now";
                            $buttonDisabled = false;

                            if ($resultFormStatus) {
                                if (mysqli_num_rows($resultFormStatus) > 0) {
                                    $rowFormStatus = mysqli_fetch_assoc($resultFormStatus);
                                    $formStatus = $rowFormStatus['status'];

                                    if ($formStatus == 'inactive') {
                                        $buttonText = "Closed";
                                        $buttonDisabled = true;
                                    }
                                }
                            }
                            ?>
                            <?php if (!$buttonDisabled): ?>
                                <button class="btn bg-warning text-dark" data-bs-toggle="modal"
                                    data-bs-target="#portfolioModal">
                                    <?php echo $buttonText; ?>
                                </button>
                            <?php else: ?>
                                <button class="btn bg-warning text-white" disabled>
                                    <?php echo $buttonText; ?>
                                </button>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- end -->
    <section id="about" class="about section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-12 col-12">
                    <div class="about-img">
                        <img src="img/mafar.jpg" alt="" class="img-fluid">
                    </div>
                </div>
                <div class="col-lg-8 col-md-12 col-12 ps-lg-5 mt-md-5">
                    <div class="about-text">
                        <h2 class="text-danger"><span style="font-weight: bold;">All About</span></h2>
                        <?php
                        include './admin/connection/config.php';

                        $sql = "SELECT about FROM system_management";
                        $result = mysqli_query($con, $sql);

                        if ($result) {
                            if (mysqli_num_rows($result) > 0) {
                                $row = mysqli_fetch_assoc($result);
                                $about = $row['about'];
                                ?>
                                <p style="text-align: justify;">
                                    <?php echo $about; ?>
                                </p>
                                <?php
                            } else {
                                $error_message = "No settings found in the database.";
                            }
                            mysqli_free_result($result);
                        } else {
                            $error_message = "Error executing the query: " . mysqli_error($conn);
                        }

                        mysqli_close($con);
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- about section Ends -->
    <!-- team starts -->
    <section class="team section-padding" id="team">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-header text-center pb-5">
                        <h2 class="text-danger"><span style="font-weight: bold;">AGRI-MATANOG TEAM</span></h2>
                        <p>PROGRAMMERS<br>2023</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-6 col-lg-3 mx-auto">
                    <div class="card text-center">
                        <div class="card-body">
                            <img src="img/waris.jpg" alt="" class="img-fluid rounded-circle">
                            <h3 class="card-title py-2">ABDULWARIS SABIDIN</h3>
                            <p class="card-text">BACHELOR OF SCIENCE IN INFORMATION TECHONOLOGY</p>
                            <p class="socials">
                                <i class="bi bi-twitter text-dark mx-1"></i>
                                <i class="bi bi-facebook text-dark mx-1"></i>
                                <i class="bi bi-linkedin text-dark mx-1"></i>
                                <i class="bi bi-instagram text-dark mx-1"></i>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3 mx-auto"> <!-- Add mx-auto class here -->
                    <div class="card text-center">
                        <div class="card-body">
                            <img src="img/image_6483441.JPG" alt="" class="img-fluid rounded-circle">
                            <h3 class="card-title py-2">JULAISA A. IBAD</h3>
                            <p class="card-text">BACHELOR OF SCIENCE IN INFORMATION TECHONOLOGY</p>

                            <p class="socials">
                                <i class="bi bi-twitter text-dark mx-1"></i>
                                <i class="bi bi-facebook text-dark mx-1"></i>
                                <i class="bi bi-linkedin text-dark mx-1"></i>
                                <i class="bi bi-instagram text-dark mx-1"></i>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3 mx-auto"> <!-- Add mx-auto class here -->
                    <div class="card text-center">
                        <div class="card-body">
                            <img src="img/adzy.jpg" alt="" class="img-fluid rounded-circle">
                            <h3 class="card-title py-2">ABDULAZIZ ALIMODIN</h3>
                            <p class="card-text">BACHELOR OF SCIENCE IN INFORMATION TECHONOLOGY</p>

                            <p class="socials">
                                <i class="bi bi-twitter text-dark mx-1"></i>
                                <i class="bi bi-facebook text-dark mx-1"></i>
                                <i class="bi bi-linkedin text-dark mx-1"></i>
                                <i class="bi bi-instagram text-dark mx-1"></i>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end -->

    <section id="map" class="contact section-padding"></section>
    <h2 class="text-danger" style="text-align: center; font-weight: bold;">OFFICE MAP</h2>
    <iframe
        src="https://www.google.com/maps/embed?pb=!4v1695750197860!6m8!1m7!1sRkYlb3Zojm7BbzB0nhlLew!2m2!1d7.467042587462521!2d124.2582820210234!3f106.18666778519855!4f6.141926332998096!5f0.7820865974627469"
        width="100%" height="800" style="border:0;" allowfullscreen="" loading="lazy"
        referrerpolicy="no-referrer-when-downgrade"></iframe>
    <!-- contact info -->
    <section id="contactinfo" class="contact section-padding">
        <div class="container mt-5 mb-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-header text-center pb-5">
                        <h2 class="text-danger"><span style="font-weight: bold;">CONTACT INFORMATION</span></h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 text-center"> <!-- First Column -->
                    <div class="contact-box">
                        <h3><i class="bi bi-telephone"></i> HOTLINE NUMBER</h3>
                        <h5 style="color: blue;">0926 861 2019</h5>

                        <h3><i class="bi bi-envelope"></i> EMAIL ACCOUNT</h3>
                        <h5 style="color: blue;">techagrisupport@gmail.com</h5>
                    </div>
                </div>
                <div class="col-md-6 text-center"> <!-- Second Column -->
                    <div class="contact-box">
                        <h3><i class="bi bi-facebook"></i> FACEBOOK ACCOUNT</h3>
                        <h5 style="color: blue;">office of The Agriculture Matanog Maguindanao</a></h5>

                        <h3><i class="bi bi-geo-alt"></i>OFFICE ADDRESS</h3>
                        <h5 style="color: blue;">Municipal hall, Bugasan sur, Matanog Maguindanao</h5>
                    </div>
                </div>
            </div>
        </div>
    </section>






    <!-- team ends -->
    <!-- Contact starts -->
    <section id="contact" class="contact section-padding">
        <div class="container mt-5 mb-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-header text-center pb-5">
                        <h2 class="text-danger"><span style="font-weight: bold;">Feedback or Question</span></h2>
                        <p>Please Fill-out All Information needed.</p>
                    </div>
                </div>
            </div>
            <div class="row m-0">
                <div class="col-md-12 p-0 pt-4 pb-4">
                    <form action="#" class="bg-light p-4 m-auto">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <input class="form-control" placeholder="Please Enter Your Full Name" required=""
                                        type="text">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <input class="form-control" placeholder="Please Enter Your Phone Number" required=""
                                        type="number">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <textarea class="form-control" placeholder="Message" required=""
                                        rows="3"></textarea>
                                </div>
                            </div>
                            <button class="btn btn-warning btn-lg btn-block mt-3" type="button">Send Now</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- contact ends -->
    <!-- footer starts -->
    <footer class="bg-dark p-2 text-center">
        <div class="container">
            <p class="text-white">All Right Reserved By @Agri-Web Team</p>
            <p class="text-white"> <a href="mafar.com">Privacy Policy</a>
                ||
                <a href="#">Terms &amp; Conditions</a>
            </p>
        </div>
    </footer>
    <!-- footer ends -->
    <!-- All Js -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/script.js"></script>
    <script>
        // Function to automatically advance the carousel
        function autoAdvanceCarousel() {
            // Get the currently active item
            const activeItem = document.querySelector('.carousel-item.active');

            // Find the next item (if it exists)
            const nextItem = activeItem.nextElementSibling;

            // If there is a next item, trigger the slide transition
            if (nextItem) {
                nextItem.classList.add('active');
                activeItem.classList.remove('active');
            } else {
                // If there is no next item, go back to the first item
                const firstItem = document.querySelector('.carousel-item:first-child');
                firstItem.classList.add('active');
                activeItem.classList.remove('active');
            }
        }

        // Set an interval to call the autoAdvanceCarousel function every 10 seconds (10000 milliseconds)
        setInterval(autoAdvanceCarousel, 5000);
    </script>
    <!-- <script>
        // JavaScript to change text color every 3 seconds
        var title = document.querySelector("#title-container h1");
        var colors = ["red", "blue", "green", "orange"]; // Define the colors you want to cycle through
        var currentColorIndex = 0;

        function changeColor() {
            title.style.color = colors[currentColorIndex];
            currentColorIndex = (currentColorIndex + 1) % colors.length;
        }

        // Initial color change
        changeColor();

        // Set an interval to change the color every 3 seconds (3000 milliseconds)
        setInterval(changeColor, 3000);
    </script> -->
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