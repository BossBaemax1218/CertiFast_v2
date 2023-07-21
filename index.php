<?php
    include 'server/dbconnect.php'; 

    $query = "SELECT * FROM tblbrgy_info WHERE id='1'";
    $result = $conn->query($query)->fetch_assoc();

    $brgyoff = "SELECT tblofficials.fullname, tblofficials.picture, tblposition.position FROM tblofficials JOIN tblposition ON tblofficials.position = tblposition.id WHERE tblposition.position IN ('Kapitan','Secretary','Treasurer','Kagawad') AND `status`='Active'";
    $brgyofficials = $conn->query($brgyoff);

    $brgyofs = array();
    while ($brgyof = $brgyofficials->fetch_assoc()) {
      $brgyofs[] = $brgyof;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
  <link href="homepage/assets/img/favicon.png" rel="icon">

  <title>CertiFast Portal</title>

    <link href="homepage/assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="homepage/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="homepage/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="homepage/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="homepage/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="homepage/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link href="homepage/assets/css/style.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>    
</head>
<body>

  <section id="topbar" class="d-flex align-items-center">
    <div class="container d-flex justify-content-center justify-content-md-between">
      <div class="contact-info d-flex align-items-center">
        <i class="bi bi-envelope d-flex align-items-center ms-4"><a href="mailto:losamigosdavaocity.gov@gmail.com"> <?= ucwords($result['brgy_email']) ?></a></i>
        <i class="bi bi-telephone d-flex align-items-center ms-4"> <span><?= ucwords($result['contact_number']) ?></span></i>
      </div>
    </div>
  </section>

  <header id="header" class="d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">
      <h1 class="logo"><a href="index.php"><img src="homepage/assets/img/title-logo.png" alt="title-logo"></a></h1>
      <nav id="navbar" class="navbar">
        <ul>
            <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
            <li><a class="nav-link scrollto" href="#about">About</a></li>
            <li><a class="nav-link scrollto" href="#services">Certificates</a></li>
            <li class="dropdown"><a href="#"><span>Officials</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a class="nav-link scrollto " href="barangay-officials.php">Barangay Officials</a></li>
              <li><a class="nav-link scrollto " href="sangguniankabataan-officials.php">SK Officials</a></li>
            </ul>
          </li>
          <li><a href="login.php" class="btn-login" style="text-decoration:none;"> Login</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav>
    </div>
  </header>

  <section id="hero" class="d-flex align-items-center">
    <div class="container" data-aos="zoom-out" data-aos-delay="100">
      <h1 style="font-size: 70px;">Welcome to <span>Barangay Los Amigos</span></h1>
      <br>
      <div class="d-flex">
        <a href="#main" class="btn-get-started scrollto">Get Started</a>
        <a href="https://www.youtube.com/watch?v=NroSCViBo1M" class="glightbox btn-watch-video"><i class="bi bi-play-circle"></i><span>Play Now</span></a>
      </div>
    </div>
  </section>

  <main id="main">
    <section id="featured-services" class="featured-services">
        <div class="container" data-aos="fade-up">
        <div class="section-title">
            <h3>Barangay Los Amigos - CertiFast Portal</h3>
            <br>
            <h6>Here are the steps in setting an registration request with CertiFast Portal.</h6>
          </div>
          <div class="row">
            <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
              <a href="#services"><div class="icon-box" data-aos="fade-up" data-aos-delay="100">
                <div class="icon"><img src="homepage/assets/img/clients/logo-8.svg"></div>
                <h4 class="title" style="color: black;">Step 1</h4>
                <h6 class="pre-title" style="color: black; font-weight: bold;">Request</h6>
                <p class="description" style="color: black;">Select the type of barangay certificate that you would like to request in CertiFast Portal.</p>
              </div></a>
            </div>

            <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
            <a href="#services"><div class="icon-box" data-aos="fade-up" data-aos-delay="100">
                <div class="icon"><img src="homepage/assets/img/clients/logo-14.svg"></div>
                <h4 class="title" style="color: black;">Step 2</h4>
                <h6 class="pre-title" style="color: black; font-weight: bold;">Review</h6>
                <p class="description" style="color: black;">Make sure your personal information is true and correct by reviewing it carefully on the screen.</p>
              </div></a>
            </div>

            <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
              <a href="#services"><div class="icon-box" data-aos="fade-up" data-aos-delay="100">
                <div class="icon"><img src="homepage/assets/img/clients/logo-10.svg"></div>
                <h4 class="title" style="color: black;">Step 3</h4>
                <h6 class="pre-title" style="color: black; font-weight: bold;">Interview</h6>
                <p class="description" style="color: black;">Giving a few essential interview at the barangay office to guarantee the authenticity of your information.</p>
              </div></a>
            </div>

            <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
              <a href="#services"><div class="icon-box" data-aos="fade-up" data-aos-delay="100">
                <div class="icon"><img src="homepage/assets/img/clients/logo-11.svg"></div>
                <h4 class="title" style="color: black;">Step 4</h4>
                <h6 class="pre-title" style="color: black; font-weight: bold;">Approval</h6>
                <p class="description" style="color: black;">Prepare a cash in hand to ensure you can pay for the certificate after a quick interview.</p>
              </div></a>
            </div>

          </div> 
        </div>
      </section>

    <section id="about" class="about section-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>About</h2>
          <h3><span>About us</span></h3>
          <br>
          <h6>Barangay Los Amigos online certificate management system has got you covered. Enjoy fast and easy access to your certificates with just a few clicks.</h6>
        </div>

        <div class="row">
          <div class="col-lg-6" data-aos="fade-right" data-aos-delay="100">
            <img src="homepage/assets/img/download.jpg" class="img-fluid" alt="">
          </div>
          <div class="col-lg-6 pt-4 pt-lg-0 content d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="100">
            <h3>Barangay Los Amigos - CertiFast Portal</h3>
            <p>
              The Certifast Portal provides a user-friendly platform for efficient and secure handling of certificates, revolutionizing the process of issuance and management.
            </p>
            <ul>
              <li>
                <i class="bx bx-check"></i>
                <div>
                  <h5>Our Mission</h5>
                  <p>Our mission is to create an efficient and secure certificate management system that ensures accuracy, accessibility, and timely delivery while maintaining data privacy and integrity.</p>
                </div>
              </li>
              <li>
                <i class="bx bx-check"></i>
                <div>
                  <h5>Our Vision</h5>
                  <p>Our vision aims to simplify certificate issuance, tracking, and management, promoting transparency and improving service delivery.</p>
                </div>
              </li>
            </ul>
          </div>
        </div>

      </div>
    </section>


    <section id="counts" class="counts">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h3><span>Resident Counter</span></h3>
        </div>
        <br>
        <div class="row">

          <div class="col-lg-3 col-md-6">
            <div class="count-box">
              <i class="bi bi-people"></i>
              <span data-purecounter-start="0" data-purecounter-end="11694" data-purecounter-duration="1" class="purecounter"></span>
              <p>Population</p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 mt-5 mt-md-0">
            <div class="count-box">
              <i class="bi bi-house"></i>
              <span data-purecounter-start="0" data-purecounter-end="11718" data-purecounter-duration="1" class="purecounter"></span>
              <p>Household</p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 mt-5 mt-lg-0">
            <div class="count-box">
              <i class="bi bi-signpost"></i>
              <span data-purecounter-start="0" data-purecounter-end="39" data-purecounter-duration="1" class="purecounter"></span>
              <p>Purok</p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 mt-5 mt-lg-0">
            <div class="count-box">
              <i class="bi bi-person"></i>
              <span data-purecounter-start="0" data-purecounter-end="18000" data-purecounter-duration="1" class="purecounter"></span>
              <p>Individuals</p>
            </div>
          </div>

        </div>

      </div>
    </section>


    <section id="clients" class="clients section-bg">
      <div class="container" data-aos="zoom-in">

        <div class="row">

          <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
            <img src="homepage/assets/img/clients/logo-1.png" class="img-fluid" alt="">
          </div>

          <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
            <img src="homepage/assets/img/clients/logo-2.png" class="img-fluid" alt="">
          </div>

          <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
            <img src="homepage/assets/img/clients/logo-3.png" class="img-fluid" alt="">
          </div>

          <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
            <img src="homepage/assets/img/clients/logo-4.png" class="img-fluid" alt="">
          </div>

          <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
            <img src="homepage/assets/img/clients/logo-5.png" class="img-fluid" alt="">
          </div>

          <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
            <img src="homepage/assets/img/clients/logo-6.png" class="img-fluid" alt="">
          </div>

        </div>

      </div>
    </section>

    <section id="services" class="services">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Services</h2>
          <h3><span>Our Offered Certificates</span></h3>
          <br>
          <h6>Say goodbye to spreadsheet tracking. Our certificate management system online provides clarity and simplifies compliance.</h6>
        </div>

        <div class="row">
          <div class="col-lg-6 col-md-6 d-flex align-items-center position-relative mt-4" data-aos="zoom-in" data-aos-delay="200">
            <div class="icon-box">
              <div class="icon"><img src="homepage/assets/img/clients/logo-2.svg"></div>
              <h4>Barangay Residency</h4>
              <p>The necessary documents for the submission of a Barangay Residency commonly include the following: </p>
              <ul class="req-list"> 
                  <li>Barangay certificate from your previous barangay (if any).</li>
                  <li>A valid ID, passport, birth certificate or marriage certificate.</li>
                  <li>Photocopy of any Utility Bill or Proof of Billing (such as electric bill, water bill, etc.) </li>
                  <li>A barangay clearance or certificate of residency.</li>
              </ul>
              <br>
              <h5><a href="login.php" class="btn-request-now">REQUEST NOW</a></h5>
            </div>
          </div>

          <div class="col-lg-6 col-md-6 d-flex align-items-center position-relative mt-4" data-aos="zoom-in" data-aos-delay="300">
            <div class="icon-box">
              <div class="icon"><img src="homepage/assets/img/clients/logo-3.svg"></div>
              <h4>Barangay Clearance</h4>
              <p>The necessary documents for the submission of a Barangay Clearance commonly include the following:</p>
              <ul class="req-list">
                  <li>Barangay certificate from your previous barangay (if any).</li>
                  <li>A valid ID, passport, birth certificate or marriage certificate.</li>
                  <li>Photocopy of any Utility Bill or Proof of Billing (such as electric bill, water bill, etc.) </li>
                  <li>A barangay clearance or certificate of residency.</li>
              </ul>
              <br>
              <h5><a href="login.php" class="btn-request-now">REQUEST NOW</a></h5>
            </div>
          </div>

          <div class="col-lg-6 col-md-6 d-flex align-items-center position-relative mt-4" data-aos="zoom-in" data-aos-delay="100">
            <div class="icon-box">
              <div class="icon"><img src="homepage/assets/img/clients/logo-5.svg"></div>
              <h4>Barangay Indingency</h4>
              <p>The necessary documents for the submission of a Barangay Indigency commonly include the following:</p>
              <ul class="req-list">
                  <li>Barangay certificate of residency.</li>
                  <li>A valid ID, passport, birth certificate or marriage certificate.</li>
                  <li>Certificate of Income. </li>
                  <li>Barangay Clearance.</li>
              </ul>
              <br>
              <h5><a href="login.php" class="btn-request-now">REQUEST NOW</a></h5>
            </div>
          </div>

          <div class="col-lg-6 col-md-6 d-flex align-items-center position-relative mt-4" data-aos="zoom-in" data-aos-delay="200">
            <div class="icon-box">
              <div class="icon"><img src="homepage/assets/img/clients/logo-9.svg"></div>
              <h4>Business Permit</h4>
              <p>The necessary documents for the submission of a Business Permit commonly include the following:</p>
              <ul class="req-list">
                  <li>Barangay Clearance.</li>
                  <li>DTI Registration or SEC Registration.</li>
                  <li>BIR Certificate of Registration. </li>
                  <li>Mayor's Permit.</li>
              </ul>
              <br>
              <h5><a href="login.php" class="btn-request-now">REQUEST NOW</a></h5>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section id="testimonials" class="testimonials">
      <div class="container" data-aos="zoom-in">

        <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="100">
          <div class="swiper-wrapper">

            <div class="swiper-slide">
              <div class="testimonial-item">
                <img src="homepage/assets/img/testimonials/testimonials-1.jpg" class="testimonial-img" alt="">
                <h3>ROBERTO A. BALLARTA</h3>
                <h4>Barangay Capitan</h4>
                <p>
                  <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                  I am very grateful for the warm support today. I hope we will be filled with many blessings and good health so that we can peacefully rest. In return, THANK YOU very much!
                  <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                </p>
              </div>
            </div>

            <div class="swiper-slide">
              <div class="testimonial-item">
                <img src="homepage/assets/img/testimonials/testimonials-2.jpg" class="testimonial-img" alt="">
                <h3>ABBIE CHARLOTTE CABIG-SARSALE</h3>
                <h4>Barangay Secretary</h4>
                <p>
                  <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                  The greatest glory in living lies not in never falling, but in rising every time we fall.
                  <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                </p>
              </div>
            </div> 
          </div>
          <div class="swiper-pagination"></div>
        </div>

      </div>
    </section>

    <section id="faq" class="faq section-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>F.A.Q</h2>
          <h3><span>Frequently Asked Question</span></h3>
          <br>
          <h6>Welcome to the Certifast Portal of Barangay Los Amigos! Here are some frequently asked questions to help you get started:</h6>
        </div>
        <br>
        <div class="row justify-content-center">
          <div class="col-xl-10">
            <ul class="faq-list">

              <li>
                <div data-bs-toggle="collapse" class="collapsed question" href="#faq1">What is Certifast Portal of Barangay Los Amigos? <i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
                <div id="faq1" class="collapse" data-bs-parent=".faq-list">
                  <p>
                    Certifast Portal of Barangay Los Amigos is a certificate management system designed to provide fast and efficient processing of certificates to community members of Barangay Los Amigos.
                  </p>
                </div>
              </li>

              <li>
                <div data-bs-toggle="collapse" href="#faq2" class="collapsed question">How does CertiFast Portal works? <i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
                <div id="faq2" class="collapse" data-bs-parent=".faq-list">
                  <p>
                  The system allows community members to request for different certificates online, such as Barangay Registration, Barangay Residency, Barangay Clearances, Barangay Indigency, Business Permit, Barangay ID. Once the certificate is processed and approved, community members may download it online via the portal.
                  </p>
                </div>
              </li>

              <li>
                <div data-bs-toggle="collapse" href="#faq3" class="collapsed question">What certificates are available for request through Certifast Portal of Barangay Los Amigos? <i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
                <div id="faq3" class="collapse" data-bs-parent=".faq-list">
                  <p>
                    Using a CertiFast Certificate Management System brings several advantages, including improved efficiency, reduced paperwork, faster processing times, enhanced accuracy, easier tracking of certificate records, and increased convenience for both administrators and applicants.
                  </p>
                </div>
              </li>

              <li>
                <div data-bs-toggle="collapse" href="#faq4" class="collapsed question">Can resident apply for certificates online? <i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
                <div id="faq4" class="collapse" data-bs-parent=".faq-list">
                  <p>Certifast Portal of Barangay Los Amigos processes different types of certificates including, but not limited to: 
                    Barangay Registration,
                    Barangay Residency,
                    Barangay Clearances,
                    Barangay Indigency,
                    Business Permit,
                    Barangay ID.
                  </p>
                </div>
              </li>

              <li>
                <div data-bs-toggle="collapse" href="#faq5" class="collapsed question">How much does it cost to request a certificate through Certifast Portal of Barangay Los Amigos? <i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
                <div id="faq5" class="collapse" data-bs-parent=".faq-list">
                  <p>
                    The cost of each certificate varies depending on the type of certificate requested. Please refer to the portal for the updated pricing of certificates.
                  </p>
                </div>
              </li>

              <li>
                <div data-bs-toggle="collapse" href="#faq7" class="collapsed question">Are there any known issues with the system? <i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
                <div id="faq7" class="collapse" data-bs-parent=".faq-list">
                  <p>
                  We strive to provide our users with the best possible experience while using our system. However, like any other system, there may be occasional issues. Please contact our customer support team if you experience any problems while using the system.
                  </p>
                </div>
              </li>

              <li>
                <div data-bs-toggle="collapse" href="#faq8" class="collapsed question">Are there any compatibility limitations for using Certifast Portal of Barangay Los Amigos? <i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
                <div id="faq8" class="collapse" data-bs-parent=".faq-list">
                  <p>
                  The system can be accessed through any device with an internet connection and web browser. However, it is recommended to use the latest version of your preferred web browser for optimal performance.
                  </p>
                </div>
              </li>

              <li>
                <div data-bs-toggle="collapse" href="#faq9" class="collapsed question">What are the key features and benefits of using Certifast Portal of Barangay Los Amigos? <i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
                <div id="faq9" class="collapse" data-bs-parent=".faq-list">
                  <p>
                  The key features and benefits of using Certifast Portal of Barangay Los Amigos include:
                   Secure and convenient way of requesting certificates,
                   Fast processing of certificates,
                   Easy online access to certificates,
                   User-friendly portal with 24/7 availability.
                  </p>
                </div>
              </li>

              <li>
                <div data-bs-toggle="collapse" href="#faq10" class="collapsed question">What should I do if I am experiencing a problem while using Certifast Portal of Barangay Los Amigos? <i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
                <div id="faq10" class="collapse" data-bs-parent=".faq-list">
                  <p>
                    If you are experiencing a problem while using Certifast Portal of Barangay Los Amigos, you can contact the support team and raise the issue.
                  </p>
                </div>
              </li>

            </ul>
          </div>
        </div>

      </div>
    </section>
  </main>
  <footer id="footer">

    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6 footer-contact">
            <h3>CertiFast</h3>
            <p><?= ucwords($result['brgy_address']) ?> <br> <br>
              <strong>Telephone:</strong> <?= ucwords($result['contact_number']) ?><br>
              <strong>Email:</strong> <?= ucwords($result['brgy_email']) ?><br>
            </p>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>CertiFast</h4>
            <ul>
              <li><a href="#">Home</a></li>
              <li><a href="#">About us</a></li>
              <li><a href="#">Services</a></li>
              <li><a href="#">Barangay Officials</a></li>
              <li><a href="#">Sk Officials</a></li>
              <li><a href="#">Contact</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Our Services</h4>
            <ul>
              <li> <a href="#">Resident Registration</a></li>
              <li> <a href="#">Residency Certificate</a></li>
              <li> <a href="#">Barangay Clearance</a></li>
              <li> <a href="#">Barangay Indingency</a></li>
              <li> <a href="#">Business Permit</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Our Social Networks</h4>
            <p>For more information, please contact us directly to our social media.</p>
            <div class="social-links mt-3">
              <a href="https://www.facebook.com/profile.php?id=100064303345469" class="facebook"><i class="bx bxl-facebook"></i></a>
              <a href="https://www.google.com/url?sa=t&rct=j&q=&esrc=s&source=web&cd=&cad=rja&uact=8&ved=2ahUKEwjI-Ma0x6b_AhWGft4KHc8sDiIQFnoECA8QAQ&url=https%3A%2F%2Fmail.google.com%2F%3F&usg=AOvVaw0UbLmQh5BLuX0lunN8sC9n" class="google-email"><i class="bx bxl-gmail"></i></a>
            </div>
          </div>

        </div>
      </div>
    </div>

    <div class="container py-4">
      <div class="copyright">
        <?php $year = date("Y"); echo  $year . " &copy; <strong><span>Barangay Los Amigos - CertiFast Portal</span></strong>" ?> . All Rights Reserved . <a class="text-muted" href="termpolicy.php#featured-term" target="_blank" style="text-decoration: none;">Term of Service</a> . <a class="text-muted" href="termpolicy.php#featured-policy" target="_blank" style="text-decoration: none;">Privacy Policy</a>
      </div>
    </div>
  </footer>

  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  <script src="homepage/assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="homepage/assets/vendor/aos/aos.js"></script>
  <script src="homepage/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="homepage/assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="homepage/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="homepage/assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="homepage/assets/vendor/waypoints/noframework.waypoints.js"></script>
  <script src="homepage/assets/vendor/php-email-form/validate.js"></script>
  <script src="homepage/assets/js/main.js"></script>
</body>
</html>