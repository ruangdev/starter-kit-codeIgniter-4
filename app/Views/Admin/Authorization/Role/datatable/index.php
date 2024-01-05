<script>
    $(document).ready(function() {
        $('#tableListRole').DataTable({
            processing: true,
            serverSide: true,
            ajax: '/cms/v1/list-role',
            order: [
                [3, 'desc']
            ],
            columns: [{
                    data: 'no',
                    orderable: false
                },
                {
                    data: 'name',
                    orderable: false
                },
                {
                    data: 'description',
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