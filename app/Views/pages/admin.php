<?= $this->extend('layouts/main') ?>   

<?= $this->section('content') ?>   


<div class="row">
<div class="col-xl-3 col-lg-6 col-md-12 col-12 mb-5 grid-margin stretch-card">
                            <!-- card -->
    <div class="card h-100 card-lift">
        <!-- card body -->
        <div class="card-body">
            <!-- heading -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <h4 class="mb-0">Orders</h4>
                </div>
                <div class="icon-shape icon-md text-primary rounded-2">
                <span class="mdi mdi-format-list-bulleted"></span>
                </div>
            </div>
            <!-- project number -->
            <div class="lh-1">
                <h1 class=" mb-1 fw-bold"><?= esc($total_orders) ?></h1>
                <p class="mb-0"><span class="text-dark me-2"><?= esc($completed_orders) ?></span>Completed</p>
            </div>
        </div>
    </div>
</div>
<div class="col-xl-3 col-lg-6 col-md-12 col-12 mb-5">
                            <!-- card -->
        <div class="card h-100 card-lift">
            <!-- card body -->
            <div class="card-body">
                <!-- heading -->
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <h4 class="mb-0">Active Jobs</h4>
                        <p class="mb-0"><span class="text-dark me-2"><?= esc($completed_jobs) ?></span>Completed</p>
                    </div>
                    <div class="icon-shape icon-md text-primary rounded-2">
                    <span class="mdi mdi-factory"></span>
                  </div>
                </div>
                <!-- project number -->
                <div class="lh-1">
                    <h1 class="  mb-1 fw-bold"><?= esc($active_jobs) ?></h1>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-12 col-12 mb-5">
        <!-- card -->
        <div class="card h-100 card-lift">
            <!-- card body -->
            <div class="card-body">
                <!-- heading -->
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <h4 class="mb-0">Active staff</h4>
                    </div>
                    <div class="icon-shape icon-md text-primary rounded-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                    </div>
                </div>
                <!-- project number -->
                <div class="lh-1">
                    <h1 class="  mb-1 fw-bold">12</h1>
                </div>
            </div>
        </div>

    </div>

<div class="row">
<div class="col-xl-8 col-12 mb-5">
<!-- card  -->
  <div class="card">
      <!-- card header  -->
      <div class="card-header ">
          <h4 class="mb-0">Active Jobs</h4>
      </div>
      <!-- table  -->
      <div class="card-body">
      <div class="table-responsive table-card">
          <table class="table text-nowrap mb-0 table-centered table-hover">
              <thead class="table-light">
                  <tr>
                    <th>Order id</th>
                    <th>Fly Code</th>
                    <th>Pattern</th>
                    <th>Type</th>
                    <th>Size</th>
                    <th>Staff Name</th>
                    <th>Quantity</th>
                    <th>Start Date</th>
                  </tr>
              </thead>
              <?php if(!empty($job)&& is_array($job)):  ?>
                        <tbody>
                    <?php if (!$jobid):
                    $i = 0;
                    foreach($job as $job):
                        // $flycode = $flycode[$i];
                    ?>       

                        <tr>
                        <td id='orderid_<?= esc($job['jobid'])?>'><?= esc($job['orderid'])?></td>
                        <td id='fly_code_<?= esc($job['jobid'])?>'><?= esc($flycode[$i])?></td>
                        <td id='fly_description_<?= esc($job['jobid'])?>'><?= esc($flyd[$i])?></td>
                        <td id='fly_description_<?= esc($job['jobid'])?>'><?= esc($job['jobtype'])?></td>
                        <td id='size_<?= esc($job['jobid'])?>'><?= esc($size[$i])?></td>
                        <td id='name_<?= esc($job['jobid'])?>'><?= esc($user[$i])?></td>
                        <td id='quantity_<?= esc($job['jobid'])?>'><?= esc($job['dqty'])?></td>
                        <!-- <td id='cost_< ?= esc($job['jobid'])?>'>< ?= esc($job['jobid'])?></td> -->

                        <!-- $amount = (int)$job['fly.cost'] * (int)$job['job.dqty']; -->
                        <td id='date_<?= esc($job['jobid'])?>'><?= esc($job['jobstart'])?></td>
                        <td>
                        <?php if (!empty($job['jobend'])){ ?>
                            <div class='badge badge-outline-success'>Complete</div>
                        <?php }else{ ?>
                            <div class='badge badge-outline-warning'>Pending</div>
                        <?php } ?>
                        </td>
                        </tr>
                        <!-- <tr id='notes_row_esc($job['fly_code'])' style='display:none;'><td colspan='8'>esc($job['notes'])</td></tr> -->
                       <?php
                       $i++;
                       endforeach;
                    endif;
                else:
                    ?>
                    <tr>No results found</tr>
                    <?php endif; ?>
            </table>
      </div>
  </div>
      <!-- card footer  -->
      <div class="card-footer text-center">
          <a href="/jobs" class="btn btn-primary">View All Jobs</a>

      </div>
  </div>

</div>

 <?= $this->endSection('content');
 