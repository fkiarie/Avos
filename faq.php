<?php include 'header.php'; ?>


    <!-- Page Header Start -->
    <div class="container-fluid page-header py-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container text-center py-5">
            <h1 class="display-2 text-dark mb-4 animated slideInDown">FAQ</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Pages</a></li>
                    <li class="breadcrumb-item text-dark" aria-current="page">Frequently Asked Question</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->

      <!-- Article Start -->
            <div style="width: 100%; margin-bottom: 0;">
                <div class="container-xxl py-5">
                    <div class="container">
                        <div class="row g-5">
                            <div class="col-lg-5 wow fadeIn" data-wow-delay="0.1s">
                            <img src="img/faq.png" width="100%">
                            </div>
                            <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                                <div class="section-title">
                                    <h1 class="display-6">Frequently Asked Question</h1>
                                </div>
                                <p class="mb-4" style="text-align: justify;">Welcome to the Frequently Asked Questions (FAQ) page of the Avocado Exporters Association of Kenya (AEAK). This page is designed to provide clear answers to the most common questions about our association, services, and membership benefits. Whether you're an exporter, farmer, or stakeholder, our FAQ section aims to address your queries and help you better understand how AEAK supports the growth and success of Kenya’s avocado industry.<br><br>

                                At AEAK, we value transparency and accessibility, which is why we’ve compiled this comprehensive FAQ section to provide you with essential information. From membership requirements to market access support and quality assurance programs, we cover a wide range of topics to meet your needs. Explore the answers below to learn how AEAK can empower your business and advance the avocado export industry in Kenya.
                                </p><hr>
                                <p style="text-align: justify; color: green;">"Advancing Kenya’s avocado industry through quality assurance, sustainable practices, market expansion, and empowering exporters for global competitiveness."</p>
              
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Article End -->

            



             <!-- Article Start -->
           <div style="background-color: #F6F6F6; width: 100%; margin-bottom: 0;">
    <div class="container-xxl py-5">
        <div class="container">
            <div class="section-title text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                <h1 class="display-6">AEAK's FAQ</h1>
            </div>

            <!-- FAQ Section Start -->
            <div class="faq-container mt-4">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- Question 1 (Default Open) -->
                        <div class="faq-item">
                            <div class="faq-question p-3 bg-white rounded shadow-sm cursor-pointer d-flex justify-content-between align-items-center">
                                <span>What is AEAK?</span>
                                <span class="faq-toggle">-</span>
                            </div>
                            <div class="faq-answer bg-light p-3 rounded-bottom shadow-sm" style="display: block;">
                                The Avocado Exporters Association of Kenya (AEAK) is a professional organization dedicated to supporting and representing avocado exporters in Kenya. It fosters sustainable farming practices, advocates for favorable policies, and connects members to global markets. AEAK helps members thrive by addressing challenges in production, export, and compliance with international standards.
                            </div>
                        </div>

                        <!-- Question 2 -->
                        <div class="faq-item mt-3">
                            <div class="faq-question p-3 bg-white rounded shadow-sm cursor-pointer d-flex justify-content-between align-items-center">
                                <span>How can I become a member?</span>
                                <span class="faq-toggle">+</span>
                            </div>
                            <div class="faq-answer bg-light p-3 rounded-bottom shadow-sm" style="display: none;">
                                To become a member of AEAK, you need to fill out the membership application form available on our official website. Applicants are also required to meet eligibility criteria, such as being actively involved in avocado production or export. Membership grants access to exclusive benefits, resources, and industry networking opportunities.
                            </div>
                        </div>

                        <!-- Question 3 -->
                        <div class="faq-item mt-3">
                            <div class="faq-question p-3 bg-white rounded shadow-sm cursor-pointer d-flex justify-content-between align-items-center">
                                <span>What benefits do members receive?</span>
                                <span class="faq-toggle">+</span>
                            </div>
                            <div class="faq-answer bg-light p-3 rounded-bottom shadow-sm" style="display: none;">
                                Members of AEAK enjoy numerous benefits, including access to market insights, training on best practices, and advocacy for favorable policies. They are connected to international buyers and gain support in meeting global export standards. Additionally, members participate in collaborative projects aimed at improving sustainability and competitiveness in the avocado export industry.
                            </div>
                        </div>

                        <!-- Question 4 -->
                        <div class="faq-item mt-3">
                            <div class="faq-question p-3 bg-white rounded shadow-sm cursor-pointer d-flex justify-content-between align-items-center">
                                <span>Does AEAK assist with market access?</span>
                                <span class="faq-toggle">+</span>
                            </div>
                            <div class="faq-answer bg-light p-3 rounded-bottom shadow-sm" style="display: none;">
                                Yes, AEAK plays a crucial role in facilitating market access for its members. The association builds strategic partnerships with international stakeholders and organizes trade missions to key markets. AEAK also provides guidance on compliance with market-specific requirements, helping members expand their reach across Europe, Asia, North America, and other regions.
                            </div>
                        </div>

                        <!-- Question 5 -->
                        <div class="faq-item mt-3">
                            <div class="faq-question p-3 bg-white rounded shadow-sm cursor-pointer d-flex justify-content-between align-items-center">
                                <span>What industries does AEAK collaborate with?</span>
                                <span class="faq-toggle">+</span>
                            </div>
                            <div class="faq-answer bg-light p-3 rounded-bottom shadow-sm" style="display: none;">
                                AEAK collaborates with multiple industries to strengthen Kenya’s avocado export sector. These include government agencies, international trade organizations, and private stakeholders. AEAK also partners with sustainability initiatives and research institutions to ensure eco-friendly farming practices. These collaborations help create a supportive ecosystem for exporters to thrive in the global market.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- FAQ Section End -->
            </div>
        </div>
    </div>

                            <script>
                                // Select all FAQ question elements
                                const faqQuestions = document.querySelectorAll('.faq-question');

                                faqQuestions.forEach(question => {
                                    question.addEventListener('click', () => {
                                        const answer = question.nextElementSibling;
                                        const toggle = question.querySelector('.faq-toggle');

                                        // If clicked question is already open, close it
                                        if (answer.style.display === 'block') {
                                            answer.style.display = 'none';
                                            toggle.textContent = '+';
                                            question.classList.remove('active');
                                        } else {
                                            // Close any open answers
                                            document.querySelectorAll('.faq-answer').forEach(ans => ans.style.display = 'none');
                                            document.querySelectorAll('.faq-toggle').forEach(toggle => toggle.textContent = '+');
                                            document.querySelectorAll('.faq-question').forEach(q => q.classList.remove('active'));

                                            // Open the clicked question
                                            answer.style.display = 'block';
                                            toggle.textContent = '-';
                                            question.classList.add('active');
                                        }
                                    });
                                });
                            </script>

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

