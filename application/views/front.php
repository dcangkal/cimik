<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" name="viewport">
    <title>VPN Free &mdash; CiMik</title>
    <link rel="shortcut icon" href="<?php echo base_url();?>">
    <link rel="stylesheet" href="<?php echo base_url().'stisla/dist/assets/modules/prism/prism.css';?>">
    <link rel="stylesheet" href="<?php echo base_url().'stisla/dist/assets/modules/bootstrap/css/bootstrap.min.css';?>">
    <link rel="stylesheet" href="<?php echo base_url().'stisla/dist/assets/modules/fontawesome/css/all.min.css';?>">
    <link rel="stylesheet" href="<?php echo base_url().'stisla/dist/assets/modules/chocolat/dist/css/chocolat.css';?>">
    <link rel="stylesheet" href="<?php echo base_url().'stisla/dist/assets/css/style.css';?>">
    <link rel="stylesheet" href="<?php echo base_url().'stisla/dist/assets/css/custom.css';?>">
    <link rel="stylesheet" href="<?php echo base_url().'stisla/dist/assets/landing/style.css';?>">
</head>

<body class="">


    <nav class="navbar navbar-reverse navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand smooth" href="#">CiMik</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto ml-lg-3 align-items-lg-center">
                    <li class="nav-item d-lg-none d-md-block"><a href="<?php echo $login ; ?>" class="nav-link smooth">Login</a></li>
                </ul>
                <ul class="navbar-nav ml-auto align-items-lg-center d-none d-lg-block">
                    <li class="ml-lg-3 nav-item">
                        <a href="<?php echo $login ; ?>" class="btn btn-round smooth btn-icon icon-left">
                            <i class="fas fa-chevron-right"></i> Login
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="hero-wrapper" id="top"> 
        <div class="hero">
            <div class="container">
                <div class="text text-center text-lg-left">
                    <a href="<?php echo $login ; ?>" class="headline">
                        <div class="badge badge-danger">New</div>
                        CiMik is now have dashboard &nbsp; <i class="fas fa-chevron-right"></i>
                    </a>
                    <h1>Free VPN Remote</h1>
                    <p class="lead">
                    CiMik didevelop menggunakan API PHP mikrotik dikombinasi dengan Framework Codeigniter. Service yang diberikan untuk saat ini adalah VPN, yang nantinya akan menambah service lainnya.
                    <br>&copy; CiMik. With <i class="fas fa-heart text-danger"></i> from Indonesia 
                    </p>
                    <div class="cta">
                        <a class="btn btn-lg btn-warning btn-icon icon-right" href="<?php echo $register ; ?>">Register <i class="fas fa-chevron-right"></i></a> &nbsp;
                        <div class="mt-3 text-job">
                            MIT License &nbsp;&nbsp;&bull;&nbsp;&nbsp; Version: 1.0.2
                        </div>
                    </div>
                </div>
                <div class="image d-none d-lg-block">
                    <img src="<?php echo base_url().'stisla/dist/assets/landing/img_1_Data_Protection.svg';?>" alt="img">
                </div>
            </div>
        </div>
    </div>
    <div class="callout container">
        <div class="row">
            <div class="col-md-6 col-12 mb-4 mb-lg-0">
                <div class="text-job text-muted text-14">CiMik cangkal.id</div>
                <div class="h1 mb-0 font-weight-bold"><span class="font-weight-500">VPN </span>statistics</div>
            </div>
            <div class="col-4 col-md-2 text-center">
                <div class="h2 font-weight-bold"><?php echo $disabled_results; ?></div>
                <div class="text-uppercase font-weight-bold ls-2 text-primary">Pending</div>
            </div>
            <div class="col-4 col-md-2 text-center">
                <div class="h2 font-weight-bold"><?php echo $total_results; ?></div>
                <div class="text-uppercase font-weight-bold ls-2 text-primary">User</div>
            </div>
            <div class="col-4 col-md-2 text-center">
                <div class="h2 font-weight-bold"><?php echo $active_results; ?></div>
                <div class="text-uppercase font-weight-bold ls-2 text-primary">Online</div>
            </div>
        </div>
    </div>

    <section id="support-us" class="support-us">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 d-none d-lg-block pr-lg-5 pr-sm-0">
                    <div class="d-flex align-items-center h-100 justify-content-center abs-images-2">
                        <img src="<?php echo base_url().'stisla/dist/assets/landing/img_2_Online_privacy.svg';?>" alt="image" class="img-fluid rounded dark-shadow">
                        <img src="<?php echo base_url().'stisla/dist/assets/landing/img_2_Online_privacy.svg';?>" alt="image" class="img-fluid rounded dark-shadow">
                        <img src="<?php echo base_url().'stisla/dist/assets/landing/img_2_Online_privacy.svg';?>" alt="image" class="img-fluid rounded dark-shadow">
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <h2>CiMik<span class="text-primary"> Yes!</span></h2>
                    <p class="lead">Kenapa sih menggunakan VPN?</p>
                    <ul class="list-icons">
                        <li>
                            <span class="card-icon bg-primary text-white">
                                <i class="fas fa-box-open"></i>
                            </span>
                            <span>Cocok buat koneksi Game yang servernya berada diluar negeri.</span>
                        </li>
                        <li>
                            <span class="card-icon bg-primary text-white">
                                <i class="fas fa-fire"></i>
                            </span>
                            <span>langganan ISP tetapi mendapat IP Public dinamis.</span>
                        </li>
                        <li>
                            <span class="card-icon bg-primary text-white">
                                <i class="fas fa-rocket"></i>
                            </span>
                            <span>langganan ISP tetapi tidak mendapat IP Public.</span>
                        </li>
                        <li>
                            <span class="card-icon bg-primary text-white">
                                <i class="fas fa-stopwatch"></i>
                            </span>
                            <span>Akses Website yang diblokir</span>
                        </li>
                        <li>
                            <span class="card-icon bg-primary text-white">
                                <i class="fas fa-heart"></i>
                            </span>
                            <span>Remote Host seperti router, cctv, server web, kontrol smarthome.</span>
                        </li>                        
                        <li>
                            <span class="card-icon bg-primary text-white">
                                <i class="fas fa-clock"></i>
                            </span>
                            <span></span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <div class="pr-lg-5">
                        <div class="mt-4 social-links">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    
    <script src="<?php echo base_url().'stisla/dist/assets/modules/jquery.min.js';?>"></script>
    <script src="<?php echo base_url().'stisla/dist/assets/modules/popper.js';?>"></script>
    <script src="<?php echo base_url().'stisla/dist/assets/modules/tooltip.js';?>"></script>
    <script src="<?php echo base_url().'stisla/dist/assets/modules/bootstrap/js/bootstrap.min.js';?>"></script>
    <script src="<?php echo base_url().'stisla/dist/assets/modules/prism/prism.js';?>"></script>
    <script src="<?php echo base_url().'stisla/dist/assets/js/stisla.js';?>"></script>
    <script src="<?php echo base_url().'stisla/dist/assets/landing/script.js';?>"></script>

    </body>
</html>
