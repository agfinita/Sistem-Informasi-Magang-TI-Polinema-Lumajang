<!-- Data Tables JS -->
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.2/js/dataTables.buttons.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.dataTables.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.colVis.min.js"></script>
<script>
    new DataTable('#example', {
    layout: {
        topStart: {
            buttons: [
                {
                    extend: 'pdfHtml5',
                    download: 'open',
                    exportOptions: {
                            columns: ':visible'
                    }
                },
                {
                    extend: 'print',
                    exportOptions: {
                            columns: ':visible'
                    }
                },
                'colvis'
            ]
        }
    }
});
</script>
