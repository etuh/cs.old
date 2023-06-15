<?= $this->extend('layouts/main') ?>   
<?= $this->section('content') ?>
<script>
          $('#datatable').DataTable( {
            dom: "<'row'<'col-sm-6'B><'col-sm-6'f>>" + 
                    "<'row'<'col-sm-12'tr>>" + 
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>" + 
                    "<'row'<'col-sm-12 notes-container'>>",
          }}
</script>
<div id="add-fly" class="row ">
        <div class="row justify-content-left">
				<div class="col-md-4 text-center mb-5">
          <a class="nav-link btn btn-success create-new-button" href="/fly/addnew">Add New Fly +</a>
				</div>
		</div>
              <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body table-wrap">
                    <h4 class="card-title">Fly list </h4>
                    <div class="table-responsive">
                    <!-- <form action="./admin/order_assign.php" method="post"> -->
                      
                        <?php if (isset($_GET['error'])) { ?>
                          <p class="error"><?php echo $_GET['error']; ?></p>
                        <?php } ?>

                            <?php if (isset($_GET['success'])) { ?>
                                <p class="success"><?php echo $_GET['success']; ?></p>
                            <?php } ?>

                            <table class="table display " id="datatable">
                            <thead>    
                            <tr style="height: 50px;">
						    	    <th>&nbsp;</th>
                                    <th>Fly Code</th>
                                    <th>Fly Name</th>
                                    <th>Fly Description</th>
                                    <th>Size</th>
                                    <th>Hook</th>
                                    <th>Barcode</th>
                                    <th>Buying Price</th>
                                    <th>Selling Price</th>
                                    <!-- <th>Fly Image</th> -->
                                    <th>Notes</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    if ($id):                                    
                                    foreach($fly as $flies): ?>
                                <tr>                                    
                                <td>
						    		<label class="checkbox-wrap checkbox-primary">
                                        <input type="checkbox">
                                        <span class="checkmark"></span>
                                    </label>
						    	</td>
                                <td id='fly_code_<?= esc($flies['fly_code'])?>'>
                                    <div class="pl-3">
                                        <span><?= esc($flies['fly_code'])?></span>
                                    </div>
						        </td>
						      <!-- <td class="status"><span class="active">Active</span></td> -->
						      	

                                    <td id='fly_name_<?= esc($flies['fly_code'])?>'><?= esc($flies['flyname'])?></td>
                                    <td id='fly_description_<?= esc($flies['fly_code'])?>'><?= esc($flies['description'])?></td>
                                    <td id='size_<?= esc($flies['fly_code'])?>'><?= esc($flies['size'])?></td>
                                    <td id='hook_<?= esc($flies['fly_code'])?>'><?= esc($flies['hook'])?></td>
                                    <td id='barcode_<?= esc($flies['fly_code'])?>'><?= esc($flies['barcode'])?></td>
                                    <td id='bpcost_<?= esc($flies['fly_code'])?>'><?= esc($flies['bpcost'])?></td>
                                    <td id='spcost_<?= esc($flies['fly_code'])?>'><?= esc($flies['spcost'])?></td>
                                    <!-- <td id='fly_image_'></td> -->
                                    <td id='fly_notes_<?= esc($flies['fly_code'])?>'><button type="button" class="btn btn-primary" onclick="document.getElementById('notes-container-<?= esc($flies['fly_code']) ?>').removeAttribute('style');">View</button></td>
                                    <td id='action_<?= esc($flies['fly_code'])?>'>
                                        <button type="button" class="btn btn-secondary" href="/fly/delete/<?= esc($flies['fly_code']) ?>">Delete</button>
                                        <button type="button" class="btn btn-secondary">Edit</button>
                                    </td>
                                </tr>
                                <!-- <tr id="notes-container-< ?= esc($flies['fly_code']) ?>" style="visibility: hidden; display: none;">
                                    <td colspan="10">
                                        <textarea id="notes-container-< ?= esc($flies['fly_code']) ?>" style="width: 100%; height: 100px; padding: 10px;">
                                            < ?= esc($flies['notes']) ?>
                                        </textarea>
                                    </td>
                                </tr> -->

                                <?php endforeach; 
                                    else:?>
                                <tr>  
                                    <td>
                                            <label class="checkbox-wrap checkbox-primary">
                                                <input type="checkbox">
                                                <span class="checkmark"></span>
                                            </label>
                                        </td>
                                        <td id='fly_code_<?= esc($flies['fly_code'])?>'>
                                        <div class="pl-3">
                                            <span><?= esc($flies['fly_code'])?></span>
                                        </div>
                                    </td>                                  
                                    <td id='fly_code_<?= esc($fly['fly_code'])?>'><?= esc($fly['fly_code'])?></td>
                                    <td id='fly_name_<?= esc($fly['fly_code'])?>'><?= esc($fly['flyname'])?></td>
                                    <td id='fly_description_<?= esc($fly['fly_code'])?>'><?= esc($fly['description'])?></td>
                                    <td id='barcode_<?= esc($fly['fly_code'])?>'><?= esc($fly['barcode'])?></td>
                                    <td id='bpcost_<?= esc($fly['fly_code'])?>'><?= esc($fly['bpcost'])?></td>
                                    <td id='spcost_<?= esc($fly['fly_code'])?>'><?= esc($fly['spcost'])?></td>
                                    <!-- <td id='fly_image_'></td> -->
                                    <td id='fly_notes_<?= esc($fly['fly_code'])?>'><button type="button" class="btn btn-primary" onclick="document.getElementById('notes-container-<?= esc($fly['fly_code']) ?>').style.display='block';">View</button></td>

                                    <td id='action_<?= esc($fly['fly_code'])?>'>
                                        <button type="button" class="btn btn-secondary">Delete</button>
                                        <button type="button" class="btn btn-secondary">Edit</button>
                                    </td>
                                </tr>
                                <td colspan="10" id="notes-container-<?= esc($fly['fly_code']) ?>" style="display: none; ">
                                    <a style="width: 100%; height: 100px;">
                                        <?= esc($fly['notes']) ?>
                                    </a>
                                </td>

                                <?php endif; ?>
                                </tbody>
                            </table>
                    </div>
                    </div>
                    </div>
                    </div>
                    </div>

<?= $this->endSection('content') ?>