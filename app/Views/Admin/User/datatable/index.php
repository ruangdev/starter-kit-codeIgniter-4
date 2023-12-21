<script>
    $(document).ready(function() {
        $('#tableAdmin').DataTable({
            processing: true,
            serverSide: true,
            ajax: '/cms/v1/list-admin',
            order: [],
            columns: [{
                    data: 'no',
                    orderable: false
                },
                {
                    data: 'username'
                },
                {
                    data: 'fullName'
                },
                {
                    data: 'email'
                },
                {
                    data: 'numberPhone'
                },
                {
                    data: 'TeleID'
                },
                {
                    data: 'action',
                    orderable: false
                },
            ]
        });
    });
</script>