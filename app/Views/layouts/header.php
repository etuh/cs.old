<!-- Required meta tags -->
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?= esc($meta_title) ?></title>


    <!-- plugins:css -->
    <link rel="stylesheet" href="/assets/vendors/bootstrap-5.3.0-alpha3-dist/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="/assets/vendors/bootstrap-5.3.0-alpha3-dist/css/bootstrap.css"> -->
    <script src="/assets/vendors/bootstrap-5.3.0-alpha3-dist/js/bootstrap.bundle.js"></script>
    <script src="/assets/vendors/bootstrap-5.3.0-alpha3-dist/js/bootstrap.js"></script>
    <script src="/assets/vendors/js/bootstrap.min.js.map"></script>

    <link rel="stylesheet" href="/assets/vendors/mdi/css/materialdesignicons.min.css">
    <!-- endplugin -->

    <!-- Layout styles -->
    <link rel="stylesheet" href="/assets/css/style.css">
    <style>
            * {
      padding: 1px;
    }

    </style>
    <!-- End layout styles -->

    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    
    <!-- datatables -->
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js" defer></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">

    <link href="https://cdn.datatables.net/v/dt/dt-1.13.4/af-2.5.3/b-2.3.6/b-colvis-2.3.6/b-html5-2.3.6/b-print-2.3.6/cr-1.6.2/date-1.4.1/fc-4.2.2/fh-3.3.2/kt-2.8.2/r-2.4.1/rg-1.3.1/rr-1.3.3/sc-2.1.1/sb-1.4.2/sp-2.1.2/sl-1.6.2/sr-1.2.2/datatables.min.css" rel="stylesheet"/>
 
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.13.4/b-2.3.6/b-html5-2.3.6/b-print-2.3.6/cr-1.6.2/date-1.4.1/fc-4.2.2/fh-3.3.2/rg-1.3.1/rr-1.3.3/sb-1.4.2/sp-2.1.2/sl-1.6.2/sr-1.2.2/datatables.min.js" defer></script>




    <script>
      $(document).ready( function () {
          $('#datatable').DataTable( {
            select: {
                style: 'single',
                toggleable: true
            },
            responsive: true,
            altEditor: true,     // Enable altEditor
            dom: 'Bfrtip',
            buttons: [
                'copy', 'excel', 'pdf',
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
        }
            ]
    });
    
      } );
      $('#datatable').dtDateTime();
    </script>

    
