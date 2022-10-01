<?php 
    $activePage = basename($_SERVER['PHP_SELF'], ".php");
?>
<header>
    <!-- Header Start -->
    <div class="header-area header-transparent">
        <div class="main-header ">
            <div class="header-top d-none d-lg-block">
                <div class="container-fluid">
                    <div class="col-xl-12">
                        <div class="row d-flex justify-content-between align-items-center">
                            <div class="header-info-left">
                                <ul>
                                    <li>+(91) 9566163232 </li>
                                    <li>design@gconengineers.com</li>
                                    <li>Mon - Sat 8:00 - 17:30, Sunday - CLOSED</li>
                                </ul>
                            </div>
                            <div class="header-info-right">
                                <ul class="header-social">
                                    <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                    <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                    <li> <a href="#"><i class="fab fa-google-plus-g"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-bottom  header-sticky">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <!-- Logo -->
                        <div class="col-xl-2 col-lg-2 col-md-1">
                            <div class="logo">
                                <!-- logo-1 -->
                                <a href="index.php" class="big-logo"><img src="assets/img/gcon-logo.png"
                                        style="width:160px;" alt=""></a>
                                <!-- logo-2 -->
                                <a href="index.php" class="small-logo"><img src="assets/img/gcon-mob-logo.png"
                                        style="width:50px;" alt=""></a>
                            </div>
                        </div>
                        <div class="col-xl-8 col-lg-8 col-md-8">
                            <!-- Main-menu -->
                            <div class="main-menu f-right d-none d-lg-block">
                                <nav>
                                    <ul id="navigation">
                                        <li><a <?php echo ($activePage=='index') ? 'style="color: #ff5f13;"' : '';?> href="index.php">Home</a></li>
                                        <li><a <?php echo ($activePage=='about') ? 'style="color: #ff5f13;"' : '';?> href="about.php">About Us</a></li>
                                        <li><a <?php echo ($activePage=='project') ? 'style="color: #ff5f13;"' : '';?> href="project.php">Projects</a></li>
                                        <li><a <?php echo ($activePage=='services') ? 'style="color: #ff5f13;"' : '';?> href="services.php" >Services</a></li>
                                        <li><a <?php echo ($activePage=='career') ? 'style="color: #ff5f13;"' : '';?> href="career.php" >Career</a></li>
                                        <li><a <?php echo ($activePage=='client') ? 'style="color: #ff5f13;"' : '';?> href="client.php" >Client</a></li>
                                        <li><a <?php echo ($activePage=='contact') ? 'style="color: #ff5f13;"' : '';?> href="contact.php">Contact Us</a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-2 col-md-3">
                            <div class="header-right-btn f-right d-none d-lg-block">
                                <a href="Brochure.pdf" target="_blank" class="btn">Brouchure</a>
                            </div>
                        </div>
                        <!-- Mobile Menu -->
                        <div class="col-12">
                            <div class="mobile_menu d-block d-lg-none"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->
</header>