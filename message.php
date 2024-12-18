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
                        $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
                        $subject = htmlspecialchars(trim($_POST['subject']));
                        $message = htmlspecialchars(trim($_POST['message']));

                        // Validate email format
                        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                            echo "Invalid email address. Please enter a valid email.";
                            exit;
                        }

                        // Check if required fields are empty
                        if (empty($name) || empty($email) || empty($subject) || empty($message)) {
                            echo "All fields are required. Please fill out the form completely.";
                            exit;
                        }

                        // Set recipient email
                        $to = "info@avocado.ke";

                        // Create a professional subject line
                        $subjectLine = 'New Message from AEAK Contact Form: ' . $subject;

                        // Format the email message content
                        $msg = "You have received a new message via the AEAK Contact Form:\n\n";
                        $msg .= "Name: $name\n";
                        $msg .= "Email: $email\n";
                        $msg .= "Subject: $subject\n";
                        $msg .= "Message:\n$message\n\n";
                        $msg .= "This message was submitted via the AEAK website contact form.";

                        // Set email headers
                        $headers = "From: no-reply@avocado.ke\r\n";
                        $headers .= "Reply-To: $email\r\n";
                        $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

                        // Send the email and confirm the result
                        if (mail($to, $subjectLine, $msg, $headers)) {
                            echo "<b>Message Sent Successfully. Thank you, $name, for reaching out to The Avocado Exporters Association of Kenya (AEAK).</b>";
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


   