<div class="page-header">
<h1>VPN<br><small>Register</small></h1>
<hr>
<form class="form form-horizontal" name="frmlogin" method="post" action="<?php echo $form_action ; ?>">	
	<div class="form-group">
		<label class="col-md-2 control-label" for="username">Email</label>
		<div class="col-md-3">
			<input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp" placeholder="email">
			<?php echo form_error('email', '<label class="control-label" for="email">', '</label>'); ?>
		</div>
	</div>
	<div class="form-group">
		<label class="col-md-2 control-label" for="username">Phone</label>
		<div class="col-md-3">
			<input class="form-control" type="tel" name="phone" id="phone" placeholder="phone">
			<?php echo form_error('phone', '<label class="control-label" for="phone">', '</label>'); ?>
		</div>
	</div>
	<div class="form-group">
		<label class="col-md-2 control-label" for="username">Username</label>
		<div class="col-md-3">
			<input class="form-control" type="text" name="username_new" id="username_new" placeholder="Username">
			<?php echo form_error('username_new', '<label class="control-label" for="username_new">', '</label>'); ?>
		</div>
	</div>
	<div class="form-group">
		<label class="col-md-2 control-label" for="password">Password</label>
		<div class="col-md-3">
			<input class="form-control" type="password" name="password_new" id="password_new" placeholder="Password">	
			<?php echo form_error('password_new', '<label class="control-label" for="password_new">', '</label>'); ?>			
		</div>
	</div>
	<div class="form-group">
		<div class="col-md-offset-2 col-md-5">
			<input class="btn btn-success" type="submit" name="btnlogin" value="Submit">
			<input class="btn btn-default" type="reset" name="btnreset" value="Reset">
		</div>
	</div>
</form>
</div>