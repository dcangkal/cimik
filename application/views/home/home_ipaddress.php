<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Remote Add &mdash; CiMik</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="<?php echo base_url().'stisla/dist/assets/modules/bootstrap/css/bootstrap.min.css';?>">
  <link rel="stylesheet" href="<?php echo base_url().'stisla/dist/assets/modules/fontawesome/css/all.min.css';?>">
  <link rel="stylesheet" href="<?php echo base_url().'stisla/dist/assets/modules/select2/dist/css/select2.min.css';?>">

  <!-- CSS Libraries -->

  <!-- Template CSS -->
  <link rel="stylesheet" href="<?php echo base_url().'stisla/dist/assets/css/style.css';?>">
  <link rel="stylesheet" href="<?php echo base_url().'stisla/dist/assets/css/components.css';?>">
<!-- Start GA -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-94034622-3');
</script>
<!-- /END GA --></head>

<body>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar">
        <form class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
          </ul>
        </form>
        <ul class="navbar-nav navbar-right">
          <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
            <img alt="image" src="<?php echo base_url().'stisla/dist/assets/img/avatar/avatar-1.png';?>" class="rounded-circle mr-1">
            <div class="d-sm-none d-lg-inline-block">Hi, <?php echo $info[0]['username']; ?></div></a>
            <div class="dropdown-menu dropdown-menu-right">
              <div class="dropdown-title">Last seen <?php echo $info[0]['last-seen']; ?></div>
              <a href="<?php echo base_url().'home/password'; ?>" class="dropdown-item has-icon text-danger">
                <i class="fas fa-edit"></i> Change Password
              </a>
              <div class="dropdown-divider"></div>
              <a href="<?php echo base_url().'auth/logout'; ?>" class="dropdown-item has-icon text-danger">
                <i class="fas fa-sign-out-alt"></i> Logout
              </a>
            </div>
          </li>
        </ul>
      </nav>
      <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="<?php echo base_url().'home'; ?>">CiMik</a>
          </div>
          <div class="sidebar-brand sidebar-brand-sm">
            <a href="<?php echo base_url().'home'; ?>">Cm</a>
          </div>
          <ul class="sidebar-menu">
            <li class="menu-header">Service</li>
            <li class="dropdown">
              <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Remote</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="<?php echo base_url().'nat'; ?>">List Remote</a></li>
              </ul>
            </li>
        </aside>
      </div>

      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Remote Add</h1>
          </div>
          

          <div class="section-body">
          <div class="row">
              <div class="col-12 col-md-6 col-lg-6">
                <div class="card">
                  <div class="card-header">
                    <h4>Port Add</h4>
                  </div>
                  <div class="card-body">
                  <form method="POST" action="<?php echo $form_action ; ?>" class="needs-validation" novalidate="">
                    <!-- <div class="form-group">
                      <label>dst-port</label></br>
                      <?php echo form_error('dst_port', '<label for="dst_port">', '</label>'); ?>
                      <input type="text" class="form-control" name="dst_port">
                    </div> -->
                    <div class="form-group">
                      <label>ip-address</label>                      
                      <?php echo form_error('ip_address', '<label for="ip_address">', '</label>'); ?>
                      <select class="form-control select2" name="ip_address">
                      <?php
                      foreach ($resultip as $val){ 
                        //echo $val. "\n"; 
                        echo "<option>$val</option>";
                      } 
                      ?>
                      </select>
                    </div>
                    <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                      Get
                    </button>
                  </div>
                </form>
                  </div>
                   <div class="card-footer">
                    Jaga kerahasiaan data ini.
                  </div>
                </div>
              </div>
          </div>
          <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Note</h4>
                  </div>
                  <div class="card-body">
                    <p class="section-title mt-0">akun ini sudah otomatis bisa digunakan sebagai akun vpn PPTP dengan server address : 206.189.84.220.</p>
                    <p class="section-title mt-0">periksa kembali status akun, apabila tidak bisa login VPN</p>
                    <p class="section-title mt-0">akun ini bersifat case-sensitive, huruf besar/kecil mempengaruhi login vpn.</p>
                    <p class="section-title mt-0">apabila ada kendala bisa email ke <a href="mailto:dani@cangkal.id">dani@cangkal.id</a> atau WA ke <a href="https://wa.me/6281346341345">081346341345</a></p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div> 
      <footer class="main-footer">
        <div class="footer-left">
          Copyright &copy; <?php echo date("Y"); ?> Developed by <a href="mailto:dani@cangkal.id">cangkal.id</a>
        </div>
        <div class="footer-right">
          
        </div>
      </footer>
    </div>
  </div>

  <!-- General JS Scripts -->
  <script src="<?php echo base_url().'stisla/dist/assets/modules/jquery.min.js';?>"></script>
  <script src="<?php echo base_url().'stisla/dist/assets/modules/popper.js';?>"></script>
  <script src="<?php echo base_url().'stisla/dist/assets/modules/tooltip.js';?>"></script>
  <script src="<?php echo base_url().'stisla/dist/assets/modules/bootstrap/js/bootstrap.min.js';?>"></script>
  <script src="<?php echo base_url().'stisla/dist/assets/modules/nicescroll/jquery.nicescroll.min.js';?>"></script>
  <script src="<?php echo base_url().'stisla/dist/assets/modules/moment.min.js';?>"></script>
  <script src="<?php echo base_url().'stisla/dist/assets/js/stisla.js';?>"></script>
  
  <!-- JS Libraies -->
  <script src="<?php echo base_url().'stisla/dist/assets/modules/select2/dist/js/select2.full.min.js';?>"></script>

  <!-- Page Specific JS File -->
  
  <!-- Template JS File -->
  <script src="<?php echo base_url().'stisla/dist/assets/js/scripts.js';?>"></script>
  <script src="<?php echo base_url().'stisla/dist/assets/js/custom.js';?>"></script>
</body>
</html>