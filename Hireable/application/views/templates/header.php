<?php
include_once('head.php');
?>
<!-- Header Section Start -->
<!-- <header id="home" class="hero-area">  -->
<!-- Navbar Start -->
<nav class="navbar navbar-expand-lg fixed-top scrolling-navbar">
  <div class="container">
    <div class="theme-header clearfix">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-navbar" aria-controls="main-navbar" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
          <span class="lni-menu"></span>
          <span class="lni-menu"></span>
          <span class="lni-menu"></span>
        </button>
        <a href="<?php echo site_url('/Home'); ?>" class="navbar-brand"><img src="<?php echo base_url(); ?>assets/img/logo1.png" alt=""></a>
      </div>
      <div class="collapse navbar-collapse" id="main-navbar">
        <ul class="navbar-nav mr-auto w-100 justify-content-end">
          <li class="nav-item">
            <a class="nav-link" href="<?php echo site_url('/Home'); ?>">
              Home
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo site_url('/About_us'); ?>">
              About us
            </a>
          </li>
          <?php
          if (isset($_SESSION['freelancerRole'])) {
            ?>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo site_url('/FreelancerProfile'); ?>">
                Profile
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo site_url('/Freelancer'); ?>">
                Dashboard
              </a>
            </li>
            <li>
            <div class="job-search-form freelancer-search-icon freelancer-form">
            <!-- <form action="<?php echo site_url('/Search'); ?>"> -->
                        <div class="row">
              <!-- <div class="col-lg-1 col-md-6 col-xs-12"> -->
                <a href="<?php echo site_url('/Search'); ?>" class="button freelancer-search-button"><i class="lni-search"></i></a>
              <!-- </div> -->
              </div>
            <!-- </form> -->
            </div>
            </li>
          <?php
          }
          if (isset($_SESSION['ClientRole'])) {
            ?>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo site_url('/ClientProfile'); ?>">
                Profile
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo site_url('/Client'); ?>">
                Dashboard
              </a>
            </li>
            <li class="button-group">
              <a href="<?php echo site_url('/AddProject'); ?>" class="button btn btn-common">Post a project</a>
            </li>
          <?php
          }
          ?>
          <?php
          if (!isset($_SESSION['logged_in'])) {
            ?>
            <li class="button-group">
              <a href="<?php echo site_url('/Signup'); ?>" class="button btn btn-common">Sign up</a>
            </li>
          <?php
          }
          ?>
          <?php if ($this->session->userdata('logged_in')) { ?>
            <li class="button-group">
              <a href="<?php echo site_url('/Logout'); ?>" class="button btn btn-common">Logout</a>
            </li>
          <?php } else { ?>
            <li class="button-group">
              <a href="<?php echo site_url('/Login'); ?>" class="button btn btn-common">Login</a>
            </li>
          <?php }
          ?>
        </ul>
      </div>
    </div>
  </div>
  <div class="mobile-menu" data-logo="<?php echo base_url(); ?>assets/img/logo-mobile.png"></div>
</nav>
<!-- Navbar End -->
</header>
<!-- Header Section End -->