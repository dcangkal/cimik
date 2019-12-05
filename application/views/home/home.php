<div class="page-header">
<h1>HOME<br><small>beranda</small></h1>
<hr>
<div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                  <i class="far fa-user"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Total Admin</h4>
                  </div>
                  <div class="card-body">
                    10
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                  <i class="far fa-newspaper"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>News</h4>
                  </div>
                  <div class="card-body">
                    42
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                  <i class="far fa-file"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Reports</h4>
                  </div>
                  <div class="card-body">
                    1,201
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                  <i class="fas fa-circle"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Online Users</h4>
                  </div>
                  <div class="card-body">
                    47
                  </div>
                </div>
              </div>
            </div>                  
          </div>
 <h2 style="margin-top:0px"><small>informasi detail</small></h2>
</br>

<table class="table">
	    <tr><td>Username</td><td><?php echo $info[0]['username']; ?></td></tr>
	    <tr><td>Password</td><td><?php echo $info[0]['password']; ?></td></tr>
	    <tr><td>Uptime</td><td><?php if(isset($info[0]['uptime-used'])){ echo $info[0]['uptime-used']; } ?></td></tr>
	    <tr><td>Download</td><td><?php if(isset($info[0]['download-used'])){ echo $info[0]['download-used']; } ?></td></tr>
	    <tr><td>Upload</td><td><?php if(isset($info[0]['upload-used'])){ echo $info[0]['upload-used']; } ?></td></tr>
	    <tr><td>Last-seen</td><td><?php echo $info[0]['last-seen']; ?></td></tr>
	    <tr><td>Ip Address</td><td><?php if(isset($info[0]['ip-address'])){ echo $info[0]['ip-address']; } ?></td></tr>
	</table>
<p>akun ini sudah otomatis bisa digunakan sebagai akun vpn PPTP dengan server address : 206.189.84.220.</p>
<p>akun ini bersifat case-sensitif, huruf besar/kecil mempengaruhi login vpn.</p>
</div>