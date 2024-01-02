<script>
    $(document).ready(function() {
        $('#tableListModule').DataTable({
            processing: true,
            serverSide: true,
            ajax: '/cms/v1/list-module',
            order: [
                [2, 'desc']
            ],
            columns: [{
                    data: 'no',
                    orderable: false
                },
                {
                    data: 'module_name',
                    orderable: false
                },
                {
                    data: 'created_at',
                    orderable: false
                },
                {
                    data: 'action',
                    orderable: false
                },
            ]
        });

        $('div.dataTables_filter input').focus();
        
    });
</script>