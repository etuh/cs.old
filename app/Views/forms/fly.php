<?= $this->extend('layouts/main') ?>   
<?= $this->section('content') ?>  

<div id="new-fly" class="row ">
              <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                  <div class="row align-items-center justify-content-center">
          <div class="col-md-7 py-5">
            <h3>Add new fly</h3>
            <p class="mb-4">Use form or upload csv file</p>
                 <br><br>
                 <?php 
					if ($success == 1) { ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
							<strong> Adding fly failed.</strong> 
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
					<?php } else if($success == 2) { ?>
						<p class="success">Fly added Successfully</p>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
							<strong> Fly added Successfully</strong> 
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
            
					<?php	
					}
					?>
            <form action="/fly/addnew" method="post">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group first">
                    <label for="flycode">Fly code</label>
                    <input type="text" class="form-control" placeholder="Fly code" name="flycode">
                  </div>    
                </div>
                <div class="col-md-6">
                  <div class="form-group first">
                    <label for="flyname">Fly name</label>
                    <input type="text" class="form-control" placeholder="Fly name" name="flyname">
                  </div>     
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group first">
                    <label for="description">Fly Description</label>
                    <input type="text" class="form-control" placeholder="Fly Description" name="flydescription">
                  </div>    
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group first">
                    <label for="Barcode">Barcode</label>
                    <input type="text" class="form-control" placeholder="Barcode" name="barcode">
                  </div>    
                </div>
                <div class="col-md-6">
                  <div class="form-group first">
                    <label for="Hook">Hook</label>
                    <select class="form-control" name="hook">
                      <option value="BR" selected>BR</option>
                      <option value="BL">BL</option>
                    </select>
                  </div>    
                </div>                
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group first">
                      <label for="cost">Buying price</label>
                      <input type="text" class="form-control" placeholder="Buying price" name="bpcost">
                    </div>    
                  </div>
                  <div class="col-md-6">
                    <div class="form-group first">
                      <label for="cost">Seling price</label>
                      <input type="text" class="form-control" placeholder="Product cost" name="spcost">
                    </div>    
                  </div>
              </div>
              <div class="row" style="display: block;">
                <div class="col-md-12">
                  <div class="form-group first mb-5 mt-4">
                    <label for="flyimage">Fly image</label>
                    <label class="upload-btn">
                      <input type="file" name="image" style="display:none">
                      <span class="mdi mdi-upload-outline"></span> Upload
                    </label>
                  </div>   
                </div>

              </div>
              <div class="row" style="display: block;">
                <div class="col-md-12">
                  <div class="form-group first mb-5 ">
                    <label for="notes">Notes</label>
                    <input type="text" class="form-control" placeholder="Notes..." name="notes">
                  </div>   
                </div>
              </div>
              <div class="row" >
                <div class="col-md-6">
                  <div class="form-group last mb-5 mt-4">
                    <label for="uploadcsv">Upload csv</label>
                    <label class="upload-btn">
                      <input type="file" name="csv" onchange="document.getElementById('csv-label').innerHTML = this.value.split('\\').pop()" style="display:none">
                      <span class="mdi mdi-upload-outline"></span> Upload
                    </label>
                    <span id="csv-label"></span>
                  </div>   
                </div>




              <div class="col-md-6" style="display: inline-block;">
                <label class="btn px-12 btn-primary" style="color: white; text-decoration: none; float: right; display: inline-block;">
                  <span class="mdi mdi-download-outline"></span> Download Csv Template
                  <input type="button" value="Download" style="display: none;" onClick="window.location.href='/dl/Addfly_Template.csv'"/>
                </label>
              </div>
              </div>

          
                  <input type="submit" value="Submit" class="btn px-5 btn-primary">
               
            </form>
          </div>
        </div>
                  </div>
                </div>
              </div>

 <?= $this->endSection('content');