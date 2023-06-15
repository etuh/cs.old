<?= $this->extend('layouts/staff') ?>   
<?= $this->section('content') ?>

    
<div id="job-list" class="row ">
    <div class="col-14 grid-margin">
    <div class="card">
        <div class="card-body">
        <h4 class="card-title">Task list </h4>
        <div class="table-responsive">
        <!-- <form action="./admin/order_assign.php" method="post"> -->
            
            <?php if (isset($_GET['error'])) { ?>
                <p class="error"><?php echo $_GET['error']; ?></p>
            <?php } ?>

                <?php if (isset($_GET['success'])) { ?>
                    <p class="success"><?php echo $_GET['success']; ?></p>
                <?php } ?>

                <div class="table-wrap">
               
                <table class="table display" id="datatable" style="width:100%">
                    <thead>
                        <tr>
                            <th>Fly Code</th>
                            <th>Pattern</th>
                            <th>Type</th>
                            <th>Size</th>
                            <th>Quantity</th>
                            <!-- <th>Cost for each</th> -->
                            <th>Start Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <?php if(!empty($job)&& is_array($job)):  ?>
                        <tbody>
                    <?php 
                    $i = 0;
                    foreach($job as $job):
                    ?>       

                        <tr>
                        <td id='fly_code_<?= esc($job['jobid'])?>'><?= esc($flycode[$i])?></td>
                        <td id='fly_description_<?= esc($job['jobid'])?>'><?= esc($flyd[$i])?></td>
                        <td id='fly_description_<?= esc($job['jobid'])?>'><?= esc($job['jobtype'])?></td>
                        <td id='size_<?= esc($job['jobid'])?>'><?= esc($size[$i])?></td>
                        <td id='quantity_<?= esc($job['jobid'])?>'><?= esc($job['dqty'])?></td>
                        <!-- <td id='cost_< ?= esc($job['jobid'])?>'>< ?= esc($job['jobid'])?></td> -->

                        <!-- $amount = (int)$job['fly.cost'] * (int)$job['job.dqty']; -->
                        <td id='date_<?= esc($job['jobid'])?>'><?= esc($job['jobstart'])?></td>
                        <td>
                        <?php if (!empty($job['jobend'])){ ?>
                            <div class='badge badge-outline-success' style="width: 100px;">Complete</div>
                        <?php }else{ ?>
                            <div id="status_<?= esc($job['jobid'])?>">
                                <div id="pending_<?= esc($job['jobid'])?>" class='badge badge-outline-warning' style="width: 100px;">Pending</div>
                                <button id="mad_<?= esc($job['jobid'])?>" type="button" onclick="markasdone(<?= esc($job['jobid'])?>)">Mark as Done</button>
                            </div>
                        <?php } ?>
                        </td>
                        </tr>
                        <!-- <tr id='notes_row_esc($job['fly_code'])' style='display:none;'><td colspan='8'>esc($job['notes'])</td></tr> -->
                       <?php
                       $i++;
                       endforeach;
                else:
                    ?>
                    <tr>No results found</tr>
                    <?php endif; ?>
                </table>

                <style>
                    button[id^="mad_"]{
                            display: none;
                        }
                    div[id^="pending_"]{
                            display: block;
                        }        
                    div[id^="status_"]:hover button[id^="mad_"]{
                            display: block;
                        }
                    div[id^="status_"]:hover div[id^="pending_"]{
                            display: none;
                        }
                </style>

    <!-- <button type="submit">Save</button>                -->
            <!-- <button type="button" id="add-new" onclick="addNewFunction()">Add New</button> -->
            <!-- <input type="text">
                <button onclick="add()">Add Row</button>
                <div id="new_count"></div>
                <input type="hidden" value="1" id="total_count"> -->
            
            <!-- </form> -->

        </div>
        </div>
    </div>
    </div>
    </div>
</div>
<?= $this->endSection() ?>