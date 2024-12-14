<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>AEAK - Avocado Exporters Association of Kenya</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.png" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Playfair+Display:wght@700;900&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
    <!-- font awesome -->
    <script src="https://kit.fontawesome.com/ceb286f3b5.js" crossorigin="anonymous"></script>
</head>
<body>
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;"></div>
    </div>
    <!-- Spinner End -->

    <!-- Navbar Start -->
    <div class="container-fluid bg-white sticky-top">
        <div class="container">
            <nav class="navbar navbar-expand-lg bg-white navbar-light py-2 py-lg-0">
                <a href="index.php" class="navbar-brand">
                    <img class="img-fluid" src="img/logo-01.png" alt="Logo">
                </a>
                <button type="button" class="navbar-toggler ms-auto me-0" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto">
                        <a href="index.php" class="nav-item nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : ''; ?>">Home</a>

                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle <?php echo in_array(basename($_SERVER['PHP_SELF']), ['about.php', 'team.php', 'vision-mission.php', 'membership.php', 'approach.php' , 'why-us.php']) ? 'active' : ''; ?>" data-bs-toggle="dropdown">About Us</a>
                            <div class="dropdown-menu bg-light rounded-0 m-0">
                                <a href="about.php" class="dropdown-item <?php echo basename($_SERVER['PHP_SELF']) == 'about.php' ? 'active' : ''; ?>">About</a>
                                <a href="team.php" class="dropdown-item <?php echo basename($_SERVER['PHP_SELF']) == 'team.php' ? 'active' : ''; ?>">Our Team</a>
                                <a href="vision-mission.php" class="dropdown-item <?php echo basename($_SERVER['PHP_SELF']) == 'vision-mission.php' ? 'active' : ''; ?>">Vision & Mission</a>
                                <a href="membership.php" class="dropdown-item <?php echo basename($_SERVER['PHP_SELF']) == 'membership.php' ? 'active' : ''; ?>">Membership</a>
                                <a href="approach.php" class="dropdown-item <?php echo basename($_SERVER['PHP_SELF']) == 'approach.php' ? 'active' : ''; ?>">Our Approach</a>
                                <a href="why-us.php" class="dropdown-item <?php echo basename($_SERVER['PHP_SELF']) == 'why-us.php' ? 'active' : ''; ?>">Why Us</a>
                            </div>
                        </div>
                        <a href="services.php" class="nav-item nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'services.php' ? 'active' : ''; ?>">Our Services</a>

                       

                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle <?php echo in_array(basename($_SERVER['PHP_SELF']), ['careers.php', 'blog.php']) ? 'active' : ''; ?>" data-bs-toggle="dropdown">Updates</a>
                            <div class="dropdown-menu bg-light rounded-0 m-0">
                                <a href="careers.php" class="dropdown-item <?php echo basename($_SERVER['PHP_SELF']) == 'careers.php' ? 'active' : ''; ?>">Careers Portal</a>
                                <a href="blog.php" class="dropdown-item <?php echo basename($_SERVER['PHP_SELF']) == 'blog.php' ? 'active' : ''; ?>">Blog Articles</a>                                
                            </div>
                        </div>

                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle <?php echo in_array(basename($_SERVER['PHP_SELF']), ['faq.php', 'contact.php', 'login-form.php']) ? 'active' : ''; ?>" data-bs-toggle="dropdown">Our Contact</a>
                            <div class="dropdown-menu bg-light rounded-0 m-0">
                                <a href="contact.php" class="dropdown-item <?php echo basename($_SERVER['PHP_SELF']) == 'contact.php' ? 'active' : ''; ?>">Contact Us</a>
                                <a href="faq.php" class="dropdown-item <?php echo basename($_SERVER['PHP_SELF']) == 'faq.php' ? 'active' : ''; ?>">FAQ</a>
                                <a href="login-form.php" class="dropdown-item <?php echo basename($_SERVER['PHP_SELF']) == 'login-form.php' ? 'active' : ''; ?>">Login</a>                                
                            </div>
                        </div>
                    </div>
                    <div class="border-start ps-4 d-none d-lg-block">
                        <button type="button" class="btn btn-sm p-0"><i class="fa fa-search"></i></button>
                    </div>
                </div>
            </nav>
        </div>
    </div>
    <!-- Navbar End -->
