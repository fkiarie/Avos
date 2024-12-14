<?php include 'header.php'; ?>


    <!-- Page Header Start -->
    <div class="container-fluid page-header py-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container text-center py-5">
            <h1 class="display-2 text-dark mb-4 animated slideInDown">Message</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Pages</a></li>
                    <li class="breadcrumb-item text-dark" aria-current="page">Message Us</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->

      <!-- Article Start -->
            <div style="width: 100%; margin-bottom: 0;">
                <div class="container-xxl py-5">
                    <div class="container">
                    <?php
                    if (isset($_POST['submit'])) {
                        // Sanitize inputs to prevent XSS
                        $name = htmlspecialchars(trim($_POST['name']));
                        $company = htmlspecialchars(trim($_POST['company']));
                        $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
                        $tel = htmlspecialchars(trim($_POST['tel']));
                        $membership_type = htmlspecialchars(trim($_POST['membership_type']));
                        $message = htmlspecialchars(trim($_POST['message']));

                        // Validate email format
                        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                            echo "Invalid email address. Please enter a valid email.";
                            exit;
                        }

                        // Check if required fields are empty
                        if (empty($name) || empty($company) || empty($email) || empty($tel) || empty($membership_type) || empty($message)) {
                            echo "All fields are required. Please fill out the form completely.";
                            exit;
                        }

                        // Set recipient email
                        $to = "info@avocado.ke";

                        // Create a professional subject line
                        $subjectLine = "New Membership Application: $name";

                        // Format the email message content
                        $msg = "A prospective member has submitted the following details to join AEAK:\n\n";
                        $msg .= "Name: $name\n";
                        $msg .= "Company: $company\n";
                        $msg .= "Email: $email\n";
                        $msg .= "Telephone: $tel\n";
                        $msg .= "Membership Type: $membership_type\n";
                        $msg .= "Message:\n$message\n\n";
                        $msg .= "This membership request was submitted via the AEAK website contact form.";

                        // Set email headers
                        $headers = "From: no-reply@avocado.ke\r\n";
                        $headers .= "Reply-To: $email\r\n";
                        $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

                        // Send the email and confirm the result
                        if (mail($to, $subjectLine, $msg, $headers)) {
                            echo "<b>Message Sent Successfully. Thank you, $name, for your interest in joining The Avocado Exporters Association of Kenya (AEAK).</b>";
                        } else {
                            echo "Failed to send the message. Please try again later.";
                        }
                    } else {
                        echo "Please complete the form and submit your message.";
                    }
                    ?>


                    </div>
                </div>
            </div>
            <!-- Article End -->

          


         <!-- Contact Start -->
        <div class="contact" style="background-image: url('img/seedling.jpg'); background-repeat: no-repeat; background-size: cover; background-attachment: fixed; width: 100%; margin: 0; padding: 0;">
            <div class="container-fluid py-5" style="margin: 0;">
                <div class="container" style="margin: 0;">
                    <br>
                    <br>
                    <br>
                    <br>
                    
                </div>
            </div>
        </div>
        <!-- Contact End -->



    <!-- Start Footer -->
    <?php include 'footer.php'; ?>
    <!-- end Footer -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top"><i class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>