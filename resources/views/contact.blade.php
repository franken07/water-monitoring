<!DOCTYPE html>
<html>
<head>
  <!--contacts-->
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="generator" content="Mobirise AI v0.01, ai.mobirise.com">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
  <link rel="shortcut icon" href="images/pond/icc.png" type="image/x-icon">
  <meta name="description" content="Explore the latest and greatest PC parts and accessories for your ultimate gaming setup or workstation.">
 
  <title>water</title>
<link rel="stylesheet" href="{{ asset('assets/web/assets/mobirise-icons2/mobirise2.css') }}">
<link rel="stylesheet" href="{{ asset('assets/parallax/jarallax.css') }}">
<link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap-grid.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap-reboot.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/dropdown/css/style.css') }}">
<link rel="stylesheet" href="{{ asset('assets/socicon/css/styles.css') }}">
<link rel="stylesheet" href="{{ asset('assets/animatecss/animate.css') }}">
<link rel="stylesheet" href="{{ asset('assets/theme/css/style.css') }}">
<link rel="preload" href="http://fonts.googleapis.com/css2?family=Inter+Tight:wght@400;700&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'">
<noscript><link rel="stylesheet" href="http://fonts.googleapis.com/css2?family=Inter+Tight:wght@400;700&display=swap"></noscript>
<link rel="preload" as="style" href="{{ asset('assets/mobirise/css/additional.css') }}">
<link rel="stylesheet" href="{{ asset('assets/mobirise/css/additional.css') }}" type="text/css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

  
  
  

  <style>:root{ --background: #EBF1FF; --dominant-color: #3772FF; --primary-color: #d2b3db; --secondary-color: #DF2935; --success-color: #31D98B; --danger-color: #DB2F40; --warning-color: #FFC20B; --info-color: #18CEF2; --background-text: #000000; --dominant-text: #FFFFFF; --primary-text: #000000; --secondary-text: #FFFFFF; --success-text: #000000; --danger-text: #FFFFFF; --warning-text: #000000; --info-text: #000000;}</style>
</head>
<body>


<!--navbar  -->
@include('include.header')


<!-- Connect With Us Section -->
<section class="connect-with-us" id="about-us">
    <div class="container-fluid py-5">
        <div class="row justify-content-center">
            <div class="col-12 text-center mb-5 fade-in-top">
                <h2 class="section-title">Connect With Us</h2>
                <p class="section-subtitle">We’d love to hear from you! Reach out to us through any of the following channels:</p>
            </div>

            <!-- Contact Information -->
            <div class="col-md-5 mb-4 fade-in-left">
                <div class="contact-card shadow-sm">
                    <h3 class="text-center mb-4">Contact Details</h3>
                    <div class="contact-info">
                        <div class="contact-item">
                            <i class="fa-solid fa-phone text-primary"></i>
                            <div>
                                <h6>Phone</h6>
                                <a href="tel:123-456-7890">123-456-7890</a>
                            </div>
                        </div>
                        <div class="contact-item">
                            <i class="fa-solid fa-envelope text-success"></i>
                            <div>
                                <h6>Email</h6>
                                <a href="mailto:info@WATERMONITORING.com">INFO@WATERMONITORING.com</a>
                            </div>
                        </div>
                        <div class="contact-item">
                            <i class="bi bi-geo-alt-fill text-danger"></i>
                            <div>
                                <h6>Address</h6>
                                <span>123 Lanas Mangaldan, Pangasinan</span>
                            </div>
                        </div>
                        <div class="contact-item">
                            <i class="fa-solid fa-clock text-warning"></i>
                            <div>
                                <h6>Working Hours</h6>
                                <span>Mon-Fri: 9am-6pm</span>
                            </div>
                        </div>
                    </div>
                    <div class="social-media mt-4 text-center">
                        <h6>Follow Us</h6>
                    </div>
                </div>
            </div>

            <!-- Google Maps Section -->
            <div class="col-md-7 fade-in-right">
                <div class="map-container shadow-sm">
                    <iframe 
                        style="width: 100%; height: 100%; border: 0; border-radius: 15px;" 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7667.5460550629705!2d120.37927769487568!3d16.077263747662947!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33916855e44bb06b%3A0x1e01cf2af7050656!2sLanas%2C%20Mangaldan%2C%20Pangasinan!5e0!3m2!1sen!2sph!4v1741701034177!5m2!1sen!2sph" 
                        allowfullscreen>
                    </iframe>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    :root {
        --primary-color:rgba(210, 179, 219);
        --secondary-color: #343A40;
        --light-bg: #F4F7FC;
        --card-bg: #fff;
        --text-muted: #6c757d;
        --box-shadow: rgba(0, 0, 0, 0.15);
    }

    .connect-with-us {
        background: linear-gradient(135deg, #E0EAFC, #CFDEF3);
        padding: 120px 0 100px; /* More bottom padding */
    }

    .section-title {
        color: black;
        font-weight: bold;
        font-size: 2.5rem;
    }

    .section-subtitle {
        color: var(--text-muted);
        font-size: 1.1rem;
        margin-bottom: 30px;
    }

    .contact-card {
        background-color: var(--card-bg);
        border-radius: 15px;
        padding: 30px;
        box-shadow: 0 8px 30px var(--box-shadow);
        transition: transform 0.3s ease;
        overflow: hidden;
    }

    .contact-card:hover {
        transform: translateY(-8px);
    }

    .contact-info {
        margin-top: 20px;
    }

    .contact-item {
        display: flex;
        align-items: center;
        padding: 15px 0;
        border-bottom: 1px solid #e9ecef;
    }

    .contact-item:last-child {
        border-bottom: none;
    }

    .contact-item i {
        font-size: 1.8rem;
        margin-right: 15px;
    }

    .contact-item a {
        color: var(--text-muted);
        text-decoration: none;
        transition: color 0.3s;
    }

    .contact-item a:hover {
        color: var(--primary-color);
    }

    .social-media .social-icon {
        display: inline-block;
        margin: 0 10px;
        color: var(--text-muted);
        font-size: 1.4rem;
        transition: color 0.3s;
    }

    .social-media .social-icon:hover {
        color: var(--primary-color);
    }

    .map-container {
        height: 100%;
        border-radius: 15px;
        box-shadow: 0 4px 20px var(--box-shadow);
        overflow: hidden;
    }

    /* Animation Styles */
    .fade-in-top {
        animation: fadeInTop 1s ease forwards;
        opacity: 0;
    }

    .fade-in-left {
        animation: fadeInLeft 1s ease forwards;
        opacity: 0;
    }

    .fade-in-right {
        animation: fadeInRight 1s ease forwards;
        opacity: 0;
    }

    @keyframes fadeInTop {
        to {
            opacity: 1;
            transform: translateY(0);
        }
        from {
            opacity: 0;
            transform: translateY(-30px);
        }
    }

    @keyframes fadeInLeft {
        to {
            opacity: 1;
            transform: translateX(0);
        }
        from {
            opacity: 0;
            transform: translateX(-30px);
        }
    }

    @keyframes fadeInRight {
        to {
            opacity: 1;
            transform: translateX(0);
        }
        from {
            opacity: 0;
            transform: translateX(30px);
        }
    }
</style>


<!--footer -->
   
<section class="footer3 cid-u3GZCsJlbC" once="footers" id="footer-3-u3GZCsJlbC">
    <div class="container">
        <div class="row">
          <p class="mbr-fonts-style copyright display-1">
            WATER MONITORING
        </p>
            <div class="col-12 mt-4">
                <div class="social-row">
                    <div class="soc-item">
                        <a href="https://www.facebook.com/profile.php?id=61574551644376" target="_blank">
                            <span class="mbr-iconfont socicon socicon-facebook display-7"></span>
                        </a>
                    </div>
                    <div class="soc-item">
                        <a href="https://twitter.com/" target="_blank">
                            <span class="mbr-iconfont socicon-twitter socicon"></span>
                        </a>
                    </div>
                    <div class="soc-item">
                        <a href="https://Instagram.com/" target="_blank">
                            <span class="mbr-iconfont socicon-instagram socicon"></span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-12 mt-5">
                <p class="mbr-fonts-style copyright display-7">
                   © 2024 WM. All Rights Reserved.
                </p>
            </div>
        </div>
    </div>
</section>

<script src="assets/parallax/jarallax.js"></script>
  <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/dropdown/js/navbar-dropdown.js"></script>
  <script src="assets/scrollgallery/scroll-gallery.js"></script>
  <script src="assets/mbr-switch-arrow/mbr-switch-arrow.js"></script>
  <script src="assets/smoothscroll/smooth-scroll.js"></script>
  <script src="assets/ytplayer/index.js"></script>
  <script src="assets/theme/js/script.js"></script>
  <script src="assets/formoid/formoid.min.js"></script>
  
  <script>

    (function(){
      var animationInput = document.createElement('input');
      animationInput.setAttribute('name', 'animation');
      animationInput.setAttribute('type', 'hidden');
      document.body.append(animationInput);
    })();

  </script>
  
</body>
</html>