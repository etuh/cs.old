<?= $this->extend('layouts/main') ?>   

<?= $this->section('content') ?>   


<div id="make-order" class="row ">
              <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                  <div class="row align-items-center justify-content-center">
                    <div class="col-md-7 py-5">
            <h3>Make new order</h3>
            <p class="mb-4">Use form or upload csv file</p>
                 <br><?php if (isset($_GET['error'])) { ?>
     		<p class="error"><?php echo $_GET['error']; ?></p>
     	<?php } ?>

          <?php if (isset($_GET['success'])) { ?>
               <p class="success"><?php echo $_GET['success']; ?></p>
               <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong> <?php echo $_GET['success']; ?></strong> 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                  </button>
                </div>
              <?php } ?><br>
            <form action="/orders/neworder" method="post">
            <div class="row">
                <div class="col-md-6">
                  <div class="form-group first">
                    <label for="orderno">Order Number</label>
                    <input type="text" class="form-control" placeholder="Order no" name="orderno">
                    <!-- <datalist id="flyCodes"></datalist> -->
                  </div>    
                </div>
                <div class="col-md-6">
                  <div class="form-group first">
                    <label for="customerid">Customer id</label>
                    <input type="text"  class="form-control" name="customerid" placeholder="Customer id">
                  </div>     
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group first">
                    <label for="flycode">Fly code</label>
                    <input type="text" class="form-control" 
                                        name="flycode"
                                        id="flycode"
                                        list="flyCodes" 
                                        placeholder="Fly Code"/>
                                <datalist id="flyCodes">
                                  <?php 

                                    if (count($flycodes) > 0) {
                                      foreach ($flycodes as $row) {
                                        echo "<option value='" . $row['fly_code'] . "' >" . $row['fly_code'] . "</option>";
                                      }
                                    } else {
                                      echo '<option value="Add Option" href="/fly/addfly">Add Option</option>';
                                    }
                                  ?>
                                </datalist>
                                  </td>
                  </div>    
                </div>
                <div class="col-md-6">
                  <div class="form-group first">
                    <label for="flyname">Fly name</label>
                    <input type="text" style="pointer-events: none;" class="form-control" name="flyname" id="flyname" placeholder="Fly Name">
                  </div>     
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group first">
                    <label for="description">Fly Description</label><br>
                    <input type="text" style="pointer-events: none;" class="form-control"name="flydescription" placeholder="Fly Description">
                  </div>    
                </div>
              </div>
              <div class="row">

                <div class="col-md-6">
                  <div class="form-group first">
                    <label for="Quantity">Quantity</label>
                    <input type="number" class="form-control" name="flyquantity" placeholder="Qty">
                  </div>    
                </div>
                <div class="col-md-6">
                  <div class="form-group first">
                    <label for="Size">Size</label>
                    <input type="number" style="pointer-events: none;" class="form-control" name="size" placeholder="Size">
                  </div>    
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group first">
                      <label for="Barcode">Barcode</label>
                      <input type="text" class="form-control" style="pointer-events: none;" name="barcode" id="barcode" placeholder="Barcode">
                    </div>    
                  </div>
              </div>
             
              <div class="row" ">
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
                    <input type="button" value="Download" style="display: none;" onClick="window.location.href='/dl/NewOrder_Template.csv'"/>
                  </label>
                </div>

              </div>
            </div>
          
                  <input type="submit" value="Submit" class="btn px-5 btn-primary">
               
            </form>
          </div>
                  </div>
                </div>
              </div>
</div>
<script>
        document.getElementById("flycode").addEventListener("change", function() {
          var selectedCode = this.value;
          // use selectedCode to query the database for the corresponding flyname, flydescription, and barcode
          var xhr = new XMLHttpRequest();
          xhr.open("POST", "/getfly", true);
          xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
          xhr.onreadystatechange = function() {
              if (xhr.readyState === 4 && xhr.status === 200) {
                  var response = JSON.parse(xhr.responseText);
                  document.getElementById("flyname").value = response.flyname;
                  document.getElementById("flydescription").value = response.flydescription;
                  document.getElementById("barcode").value = response.barcode;
                  document.getElementById("size").value = response.size;
              }
          }
          xhr.send("flycode=" + selectedCode);
        });
</script>

 <?= $this->endSection('content');
