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
    ajax: {
        url : url_ws_mock_get,
        // our data is an array of objects, in the root node instead of /data node, so we need 'dataSrc' parameter
        dataSrc : ''
    },
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
            url: url_ws_mock_ok,
            type: 'GET',
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

  myTable.rows().every(function() {
    var data = this.data();
    data.fly_code = flycode[data.jobid - 1];
    this.data(data);
  });


});

