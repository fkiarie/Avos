<?php include 'header.php'; ?>

    <!-- Page Header Start -->
    <div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container text-center py-5">
            <h1 class="display-2 text-dark mb-4 animated slideInDown">Login Page</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Pages</a></li>
                    <li class="breadcrumb-item text-dark" aria-current="page">Login In</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->


<!-- Contact Start -->
<div class="container-xxl contact py-5">
    <div class="container">
        <div class="section-title text-center mx-auto" style="max-width: 500px;">
            <h1 class="display-6">Member Login</h1>
        </div>
        <div class="row g-5 justify-content-center align-items-center">
            <div class="col-lg-9">
                <div class="login-form-wrapper"> <!-- New Wrapper Class -->
                    <p class="mb-4 text-center">
                        Log in to manage your account, customize your preferences, and explore exclusive benefits while staying connected with our services.
                    </p>
                    <form action="login.php" method="POST" class="login-form">
                        <div class="form-floating mb-3">
                            <input 
                                type="email" 
                                class="form-control" 
                                name="email" 
                                placeholder="Enter your email address" 
                                required>
                            
                        </div>
                        <div class="form-floating mb-3">
                            <input 
                                type="password" 
                                class="form-control" 
                                name="pass" 
                                placeholder="Enter your password" 
                                required>
                          
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="rememberMe">
                                <label class="form-check-label" for="rememberMe">Remember Me</label>
                            </div>
                            <a href="#" class="forgot-password">Forgot Password?</a>
                        </div>
                        <button type="submit" name="login" class="btn btn-primary rounded-pill py-3 px-5 w-100">Login</button>
                    </form>
                </div>
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