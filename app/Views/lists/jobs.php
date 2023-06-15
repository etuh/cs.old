<?= $this->extend('layouts/main') ?>   
<?= $this->section('content') ?>

<script>
    $(document).ready(function() {

var columnDefs = [{
  data: "id",
  title: "Order id",
  type: "readonly"
},
{
  data: "flycode",
  title: "Fly Code"
},
{
  data: "pattern",
  title: "Pattern"
},
{
  data: "type",
  title: "Type"
},
{
  data: "size",
  title: "size"
},
{
  data: "staffname",
  title: "Staff Name"
},
{
  data: "quantity",
  title: "Quantity"
},
{
  data: "startdate",
  title: "Start Date",
  datetimepicker: { timepicker: true, format : "Y/m/d H:i"}
},
{
  data: "status",
  title: "status"
},

];

var myTable;

var job = <?php echo json_encode($job); ?>;
var flycode = <?php echo json_encode($flycode); ?>;


// local URL's are not allowed
var url_ws_mock_get = './mock_svc_load.json';
var url_ws_mock_ok = './mock_svc_ok.json';
// if (location.href.startsWith("file://")) {
  // local URL's are not allowed
  url_ws_mock_get = 'https://luca-vercelli.github.io/DataTable-AltEditor/example/10_file_upload/mock_svc_load.json';
  url_ws_mock_ok = 'https://luca-vercelli.github.io/DataTable-AltEditor/example/10_file_upload/mock_svc_ok.json';
// }

myTable = $('#example').DataTable({
  "sPaginationType": "full_numbers",
  data:   
  columns: columnDefs,
  dom: 'Bfrtip',        // Needs button container
  select: 'single',
  responsive: true,
  altEditor: true,     // Enable altEditor
  buttons: [{
          text: 'Add',
          name: 'add'        // do not change name
      },
      {
          extend: 'selected', // Bind to Selected row
          text: 'Edit',
          name: 'edit'        // do not change name
      },
      {
          extend: 'selected', // Bind to Selected row
          text: 'Delete',
          name: 'delete'      // do not change name
      },
      {
          text: 'Refresh',
          name: 'refresh'      // do not change name
      }],
  onAddRow: function(datatable, rowdata, success, error) {
      $.ajax({
          // a tipycal url would be / with type='PUT'
          url: /order/assignorder,
          type: 'POST',
          data: rowdata,
          success: success,
          error: error
      });
  },
  onDeleteRow: function(datatable, rowdata, success, error) {
      $.ajax({
          // a tipycal url would be /{id} with type='DELETE'
          url: url_ws_mock_ok,
          type: 'GET',
          data: rowdata,
          success: success,
          error: error
      });
  },
  onEditRow: function(datatable, rowdata, success, error) {
      $.ajax({
          // a tipycal url would be /{id} with type='POST'
          url: url_ws_mock_ok,
          type: 'GET',
          data: rowdata,
          success: success,
          error: error
      });
  }
});



});
$(function() {
  var oTable = $('#datatable').DataTable({
    "oLanguage": {
      "sSearch": "Filter Data"
    },
    "iDisplayLength": -1,
    "sPaginationType": "full_numbers",

  });




  $("#datepicker_from").datepicker({
    showOn: "button",
    buttonImage: "images/calendar.gif",
    buttonImageOnly: false,
    "onSelect": function(date) {
      minDateFilter = new Date(date).getTime();
      oTable.fnDraw();
    }
  }).keyup(function() {
    minDateFilter = new Date(this.value).getTime();
    oTable.fnDraw();
  });

  $("#datepicker_to").datepicker({
    showOn: "button",
    buttonImage: "images/calendar.gif",
    buttonImageOnly: false,
    "onSelect": function(date) {
      maxDateFilter = new Date(date).getTime();
      oTable.fnDraw();
    }
  }).keyup(function() {
    maxDateFilter = new Date(this.value).getTime();
    oTable.fnDraw();
  });

});

// Date range filter
minDateFilter = "";
maxDateFilter = "";

$.fn.dataTableExt.afnFiltering.push(
  function(oSettings, aData, iDataIndex) {
    if (typeof aData._date == 'undefined') {
      aData._date = new Date(aData[0]).getTime();
    }

    if (minDateFilter && !isNaN(minDateFilter)) {
      if (aData._date < minDateFilter) {
        return false;
      }
    }

    if (maxDateFilter && !isNaN(maxDateFilter)) {
      if (aData._date > maxDateFilter) {
        return false;
      }
    }

    return true;
  }
);

</script>
    
<div id="job-list" class="row ">
    <div class="col-14 grid-margin">
    <div class="card">
        <div class="card-body">
        <h4 class="card-title">Jobs list </h4>
        <div class="table-responsive">
        <!-- <form action="./admin/order_assign.php" method="post"> -->
            
            <?php if (isset($_GET['error'])) { ?>
                <p class="error"><?php echo $_GET['error']; ?></p>
            <?php } ?>

                <?php if (isset($_GET['success'])) { ?>
                    <p class="success"><?php echo $_GET['success']; ?></p>
                <?php } ?>

                <div class="table-wrap">
                <p id="date_filter">
                    <span id="date-label-from" class="date-label">From: </span><input class="date_range_filter date" type="text" id="datepicker_from" />
                    <span id="date-label-to" class="date-label">To:<input class="date_range_filter date" type="text" id="datepicker_to" />
                </p>
               
                <table class="dataTable table display" id="example" style="width:100%">
                    <thead>
                        <tr>
                            <th>Order id</th>
                            <th>Fly Code</th>
                            <th>Pattern</th>
                            <th>Type</th>
                            <th>Size</th>
                            <th>Staff Name</th>
                            <th>Quantity</th>
                            <!-- <th>Cost for each</th> -->
                            <th>Start Date</th>
                            <th>Status</th>
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