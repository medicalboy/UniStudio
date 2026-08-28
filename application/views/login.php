<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<div class="container">
      <div class="col-4 offset-4">
			<?php echo form_open(base_url().'login/check_login'); ?>
				<h2 class="text-center">Login</h2>       
					<div class="form-group">
						<input type="text" class="form-control" placeholder="Username" required="required" name="username">
					</div>
					<div class="form-group">
						<input type="password" class="form-control" placeholder="Password" required="required" name="password">
					</div>
					<div class="form-group">
					<?php echo $error; ?>
					</div>
					<div class="form-group">
						<button type="submit" class="btn-block btn-primary" height="16">Log in</button>
					</div>
					<div class="clearfix">
						<label class="float-left form-check-label"><input type="checkbox" name="remember"> Remember me</label>
						<a href="<?php echo base_url(); ?>email" class="float-right">Forgot Password?</a>
					</div>    
			<?php echo form_close(); ?>
	</div>
</div>

