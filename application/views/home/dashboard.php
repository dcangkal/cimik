<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Dashboard &mdash; CiMik</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="<?php echo base_url().'stisla/dist/assets/modules/bootstrap/css/bootstrap.min.css';?>">
  <link rel="stylesheet" href="<?php echo base_url().'stisla/dist/assets/modules/fontawesome/css/all.min.css';?>">

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
            <a href="<?php echo base_url().'home'; ?>">CM</a>
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
            <h1>Dashboard</h1>
          </div>
          

          <div class="section-body">
          <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                  <i class="far fa fa-microchip"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>CPU Load</h4>
                  </div>
                  <div class="card-body">
                    <?php echo $resource[0]['cpu-load']; ?> %
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                  <i class="far fa fa-server"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Free Memory</h4>
                  </div>
                  <div class="card-body">
                    <?php echo $this->formatbytesbites->formatBytes($resource[0]['free-memory']); ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                  <i class="far fa fa-hdd"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Free HDD</h4>
                  </div>
                  <div class="card-body">
                    <?php echo $this->formatbytesbites->formatBytes($resource[0]['free-hdd-space']); ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                  <i class="fas fa fa-power-off"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Uptime</h4>
                  </div>
                  <div class="card-body">
                    <?php echo $resource[0]['uptime']; ?>
                  </div>
                </div>
              </div>
            </div>                  
          </div>
          <div class="row">
              <div class="col-12 col-md-6 col-lg-6">
                <div class="card">
                  <div class="card-header">
                    <h4>Account Detail</h4>
                  </div>
                  <div class="card-body">
                    <table class="table">
                      <thead>
                        <tr>
                          <th scope="col">Status</th>
                          <th scope="col"><?php if ($info[0]['disabled']=="true"){echo "non-aktif";}
                          else  {
                          echo "Aktif";
                           } ?></th>
                      </thead>
                      <tbody>
                      <tr>
                          <th scope="row">First Name</th>
                          <td><?php if(isset($info[0]['first-name'])){echo $info[0]['first-name'];} ?></td>
                        </tr>
                        <tr>
                          <th scope="row">Last Name</th>
                          <td><?php if(isset($info[0]['last-name'])){echo $info[0]['last-name'];} ?></td>
                        </tr>
                        <tr>
                          <th scope="row">Email</th>
                          <td><?php if(isset($info[0]['last-name'])){echo $info[0]['email'];} ?></td>
                        </tr>
                        <tr>
                          <th scope="row">Phone</th>
                          <td><?php if(isset($info[0]['last-name'])){echo $info[0]['phone'];} ?></td>
                        </tr>
                        <tr>
                          <th scope="row">Username</th>
                          <td><?php echo $info[0]['username']; ?></td>
                        </tr>
                        <tr>
                          <th scope="row">Password</th>
                          <td><?php echo $info[0]['password'] ; ?></td>
                        </tr>
                         <tr>
                          <th scope="row">Change Password</th>
                          <td><a href="<?php echo base_url().'home/password';?>">Klik Disini</a></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                   <div class="card-footer">
                    Jaga kerahasiaan data ini.
                  </div>
                </div>
              </div>
              <div class="col-12 col-md-6 col-lg-6">
                <div class="card">
                  <div class="card-header">
                    <h4>Account Statistic</h4>
                  </div>
                  <div class="card-body">
                    <table class="table">
                      <thead>
                        <tr>
                          <th scope="col">Status</th>
                          <th scope="col"><?php if ($online==1){echo "Online";}
                          else  {
                          echo "Offline";
                           } ?></th>
                      </thead>
                      <tbody>
                        <tr>
                          <th scope="row">Uptime Used</th>
                          <td><?php if(isset($info[0]['uptime-used'])){ echo $info[0]['uptime-used']; } ?></td>
                        </tr>
                        <tr>
                          <th scope="row">Download Used</th>
                          <td><?php if(isset($info[0]['download-used'])){ echo $this->formatbytesbites->formatBytes($info[0]['download-used']); } ?></td>
                        </tr>
                        <tr>
                          <th scope="row">Upload Used</th>
                          <td><?php if(isset($info[0]['upload-used'])){ echo $this->formatbytesbites->formatBytes($info[0]['upload-used']); } ?></td>
                        </tr>
                        <tr>
                          <th scope="row">Last Seen</th>
                          <td><?php echo $info[0]['last-seen']; ?></td>
                        </tr>
                        <tr>
                          <th scope="row">Ip Address</th>
                          <td><?php if(isset($info[0]['ip-address'])){ echo $info[0]['ip-address']; } ?></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                   <div class="card-footer">
                    
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

  <!-- Page Specific JS File -->
  
  <!-- Template JS File -->
  <script src="<?php echo base_url().'stisla/dist/assets/js/scripts.js';?>"></script>
  <script src="<?php echo base_url().'stisla/dist/assets/js/custom.js';?>"></script>
</body>
</html>