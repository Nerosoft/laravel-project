<script type="text/javascript">
    document.addEventListener("DOMContentLoaded", function() {
        new DataTable('#example',{
            "oLanguage": {
                "sSearch": @json($lang->table1),
                "sEmptyTable":  @json($lang->table3)
            },
            "language": {
                "lengthMenu": "_MENU_ " + @json($lang->table5),
                "info":  @json($lang->table4) + " _MAX_",
                "zeroRecords":  @json($lang->table3),
                "infoEmpty": @json($lang->table2),
                "infoFiltered": @json($lang->table6) + " _END_ --- _TOTAL_"
            },
            pageLength : 10,
            lengthMenu: [[10, 20, -1], [10, 20, 'All']],
            filter: true,
            deferRender: true,
            scrollY: '67vh',
            scrollCollapse: true,
            scroller: true,
            columns: setting
        });
    });  
</script>