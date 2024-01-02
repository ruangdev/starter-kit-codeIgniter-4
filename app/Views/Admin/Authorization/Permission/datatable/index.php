<script>
    $(document).ready(function() {
        $('#tableListPermission').DataTable({
            processing: true,
            serverSide: true,
            ajax: '/cms/v1/list-permission',
            order: [
                [4, 'desc']
            ],
            columns: [{
                    data: 'no',
                    orderable: false
                },
                {
                    data: 'name'
                },
                {
                    data: 'module_name',
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
    });
</script>