<?= $this->extend('layouts/min') ?>   
<?= $this->section('content') ?>  

<div id="login-process" class="row ">
	<div class="col-12 grid-margin">
    	<div class="card">
        	<div class="card-body">
<section class="ftco-section">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-6 text-center mb-5">
				<h2 class="heading-section">Login</h2>
			</div>
		</div>
		<div class="row justify-content-center">
			<div class="col-md-7 col-lg-5">
				<div class="login-wrap p-4 p-md-5">
					<h2>Sign in</h2>
					<?php 
					if ($success == 1) { ?>
						<div class="alert alert-danger alert-dismissible fade show" role="alert">
							<strong> Login failed.</strong> Wrong username or password.
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>

					<?php } ?>
     <form action="/login" method="post">
     	
		  <div class="form-group">
     	<label>User Name</label>
     	<input type="text" name="username" placeholder="Username"class="form-control"><br>
		  </div>
		  <div class="form-group">
     	<label>Password</label>
     	<input type="password" name="password" placeholder="Password"class="form-control"><br>
		  </div>
     	<button type="submit" class="btn btn-primary submit">Login</button>
		<div>Don't have an account, <a href="/signup">create account</a></div>

          <!-- <div class="g-signin2" data-onsuccess="onSignIn" href="/"></div> -->

     </form>
	 </div>
			</div>
		</div>
	</div>
</section>

		</div>
	</div>
	</div>
	</div>


	 <?= $this->endSection('content');