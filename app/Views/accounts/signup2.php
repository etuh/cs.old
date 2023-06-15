<?= $this->extend('layouts/min') ?>   
<?= $this->section('content') ?>  

<div id="signup-process" class="row ">
              <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
    
                  <section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
					<h2 class="heading-section">Add new user</h2>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-7 col-lg-5">
					<div class="login-wrap p-4 p-md-5">
		      	<h3 class="mb-4">Register</h3>
				  <?php 
					if ($success == 1) { ?>
						<p class="error"> Registration failed</p>
					<?php } else if($success == 2) { ?>
						<p class="success">Registration Successful</p>
					<?php	
					}
					?>
		<form method="post"action="/users/register" class="signup-form">
		      		<div class="form-group">
		      			<label class="label" for="name">Full Name</label>
		      			<input type="text" name="name"class="form-control" placeholder="John Doe">
		      		</div>
		      		<div class="form-group">
						<label class="label" for="uname">Username</label>
						<input type="text" name="username" class="form-control" placeholder="John">
					</div>
					<div class="form-group">
						<label class="label" for="email">Email</label>
						<input type="email" name="email" class="form-control" placeholder="john@example.com">
					</div>

				<div class="form-group">
				  <label for="">Type of user</label>
				  <select class="form-control" name="type" id="usertype">
						<option value="customer">Customer</option>
						<option value="user">Employee</option>
						<option value="manager">Manager</option>
						<option value="admin">Admin</option>
					</select>
				</div>

				<div class="form-group" id="staffidinput" style="display:none;">
						<label>Staff id</label>
					<input type="text" name="staffid"  class="form-control" placeholder="Staff id" >
					
						<label>Type</label>
						<select  class="form-control" name="stafftype" id="stafftype">
								<option value="tyer">Tyer</option>
								<option value="sampler">Sampler</option>
								<option value="qc">Quality Control 1</option>
								<option value="qc2">Quality Control 2</option>
								<option value="packaging">Packaging</option>
								<option value="labeling">Labelling</option>
						</select>
				</div>
				<script>
					// Get the select element and the staffidinput form group
					const userTypeSelect = document.getElementById('usertype');
					const staffIdInput = document.getElementById('staffidinput');

					// Add an event listener to the select element
					userTypeSelect.addEventListener('change', function() {
					// Check if the selected option is "user"
					if (this.value === 'user') {
						// If it is, change the display of the staffidinput form group to "block"
						staffIdInput.style.display = 'block';
					} else {
						// If it's not, change the display of the staffidinput form group to "none"
						staffIdInput.style.display = 'none';
					}
					});
				</script>


	            <div class="form-group d-flex justify-content-end mt-5">
	            	<button type="submit" class="btn btn-primary submit"><span class="fa"> Register </span></button>
	            </div>
				<div>Already have an account, <a href="/login">Login</a></div>
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