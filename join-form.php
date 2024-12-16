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
                <h1 class="display-6">Join AEAK TODAY</h1>
            </div>
            <div class="row g-5">
                
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="h-100">
                       <img src="img/join-form.jpg" width="100%">
                    </div>
                </div>

                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <p class="mb-4" style="text-align: justify;">Fill out the form below to become a member of the Avocado Exporters Association of Kenya (AEAK). For any inquiries, support, or membership details, our team is here to guide and empower Kenya’s avocado exporters globally.</p>
                    <form action="join.php" method="post">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" name="name" placeholder="Your Name">
                                    <label for="name">Your Name</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" name="company" placeholder="Your Email">
                                    <label for="company">Company Name</label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="email" class="form-control" name="email" placeholder="Your Name">
                                    <label for="email">Email</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" name="tel" placeholder="Your Email">
                                    <label for="tel">Phone No..</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating ">
                                    <select class="form-select" name="membership_type" required>
                                        <option value="" disabled selected>Select Membership Type</option>
                                        <option value="Premium">Premium</option>
                                        <option value="Standard">Standard</option>
                                    </select>
                                    <label for="membership_type">Membership Type</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea class="form-control" placeholder="Leave a message here" name="message" style="height: 120px"></textarea>
                                    <label for="message">Message</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary rounded-pill py-3 px-5" type="submit" name="submit">JOIN AEAK</button>
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


    