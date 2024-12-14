<?php include 'header.php'; ?>
    <!-- Page Header Start -->
    <div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container text-center py-5">
            <h1 class="display-2 text-dark mb-4 animated slideInDown">Join Us</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Pages</a></li>
                    <li class="breadcrumb-item text-dark" aria-current="page">Join Us</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Contact Start -->
    <div class="container-xxl contact py-5">
        <div class="container">
            <div class="section-title text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                <h1 class="display-6">Member Register Page</h1>
            </div>
            <div class="row g-5">
                
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="h-100">
                       <img src="img/join.png" width="100%">
                    </div>
                </div>

                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <p class="mb-4" style="text-align: justify;">Join us today and unlock exclusive membership benefits. Complete the registration form to become part of our thriving community. Stay connected, access valuable resources, and enjoy tailored services designed to empower and support your success.</p>
                    <form action="users.php" method="POST">
                        <!-- CSRF Token -->
                        <input type="hidden" name="csrf_token" value="YOUR_GENERATED_CSRF_TOKEN">

                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" name="name" placeholder="Your Name" required minlength="3">
                                    <label for="name">Your Name</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" name="username" placeholder="Username" required pattern="^[a-zA-Z0-9_]{3,15}$">
                                    <label for="username">Username</label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="email" class="form-control" name="email" placeholder="Email" required>
                                    <label for="email">Email</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="tel" class="form-control" name="tel" placeholder="Phone No" required pattern="^\+?\d{10,13}$">
                                    <label for="tel">Phone No.</label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="password" class="form-control" name="password" placeholder="Password" required minlength="8">
                                    <label for="password">Password</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="password" class="form-control" name="confirm_password" placeholder="Confirm Password" required minlength="8">
                                    <label for="confirm_password">Confirm Password</label>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-floating">
                                    <select class="form-select" name="role_type" required>
                                        <option value="" disabled selected>Select Role Type</option>
                                        <option value="Admin">Admin</option>
                                        <option value="Moderator">Moderator</option>
                                    </select>
                                    <label for="role_type">Role Type</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary rounded-pill py-3 px-5" type="submit" name="submit">Register</button>
                            </div>
                        </div>
                    </form>
                </div>



            </div>
        </div>
    </div>
    <!-- Contact End -->

     <!-- Contact Start -->
<div class="contact" style="background-image: url('img/seedling.jpg'); background-repeat: no-repeat; background-size: cover; background-attachment: fixed; width: 100%; margin: 0; padding: 0;">
    <div class="container-fluid py-5" style="margin: 0;">
      
            <br>
            <br>
            <center><h4 style="color: white">"Empowering Avocado Exporters with Market Access, Quality Assurance, Sustainable Practices, and Industry Advocacy Excellence."</h4>
                
            </center>
            <br>
            <br>
            
      
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