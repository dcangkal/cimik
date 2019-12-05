<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Register &mdash; CiMik</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="<?php echo base_url().'stisla/dist/assets/modules/bootstrap/css/bootstrap.min.css';?>">
  <link rel="stylesheet" href="<?php echo base_url().'stisla/dist/assets/modules/fontawesome/css/all.min.css';?>">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="<?php echo base_url().'stisla/dist/assets/modules/jquery-selectric/selectric.css';?>">

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
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
            <div class="card card-primary">
              <div class="card-header"><h4>Register</h4></div>

              <div class="card-body">
                <form method="POST"  action="<?php echo $form_action ; ?>" class="needs-validation" >
                  <div class="row">
                    <div class="form-group col-6">
                      <label for="frist_name">First Name</label>
                      <input id="first_name" type="text" class="form-control" name="first_name" autofocus>
                      <?php echo form_error('first_name', '<label  for="first_name">', '</label>'); ?>
                    </div>
                    <div class="form-group col-6">
                      <label for="last_name">Last Name</label>
                      <input id="last_name" type="text" class="form-control" name="last_name">
                      <?php echo form_error('last_name', '<label  for="last_name">', '</label>'); ?>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" class="form-control" aria-describedby="emailHelp" name="email">
                    <?php echo form_error('email', '<label  for="email">', '</label>'); ?>
                  </div>

                  <div class="form-group">
                    <label for="phone" class="d-block">Phone</label>
                    <input id="phone" type="tel" class="form-control" name="phone">
                    <?php echo form_error('phone', '<label  for="phone">', '</label>'); ?>
                  </div>
                  
                  <div class="row">
                    <div class="form-group col-6">
                      <label for="username" class="d-block">Username</label>
                      <input id="username_new" type="text" class="form-control" name="username_new">
                      <?php echo form_error('username_new', '<label for="username_new">', '</label>'); ?>
                    </div>
                  </div>

                  <div class="row">
                    <div class="form-group col-6">
                      <label for="password" class="d-block">Password</label>
                      <input id="password_new" type="password" class="form-control" name="password_new">
                      <?php echo form_error('password_new', '<label for="password_new">', '</label>'); ?>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" name="agree" class="custom-control-input" id="agree">
                      <label class="custom-control-label" for="agree">I agree with the terms and conditions</label>
                    </div>
                  </div>

                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block">
                      Register
                    </button>
                  </div>
                </form>
              </div>
            </div>
            <div class="simple-footer">
               Copyright &copy; <?php echo date("Y"); ?> Developed by <a href="mailto:dani@cangkal.id">cangkal.id</a>
            </div>
          </div>
        </div>
      </div>
    </section>
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
  <script src="<?php echo base_url().'stisla/dist/assets/modules/jquery-pwstrength/jquery.pwstrength.min.js';?>"></script>
  <script src="<?php echo base_url().'stisla/dist/assets/modules/jquery-selectric/jquery.selectric.min.js';?>"></script>

  <!-- Page Specific JS File -->
  <script src="<?php echo base_url().'stisla/dist/assets/js/page/auth-register.js';?>"></script>
  
  <!-- Template JS File -->
  <script src="<?php echo base_url().'stisla/dist/assets/js/scripts.js';?>"></script>
  <script src="<?php echo base_url().'stisla/dist/assets/js/custom.js';?>"></script>
</body>
</html>