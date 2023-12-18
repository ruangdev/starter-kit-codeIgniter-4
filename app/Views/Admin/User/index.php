<?= $this->extend('Admin/layout/app') ?>

<?= $this->section('csscustom') ?>
<link href="https://cdn.datatables.net/v/bs5/jq-3.7.0/dt-1.13.8/datatables.css" rel="stylesheet">
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="page-title">
    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <h4 class="card-title">
                List Data User
            </h4>
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="">Authorization</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Admin</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<section class="section">
    <div class="card">
        <div class="card-body">
            <table class="table table-hover table-striped" id="tableAdmin">
                <thead class="table-dark">
                    <tr>
                        <th class="text-left" width="100px">Username</th>
                        <th class="text-left" width="100px">Full Name</th>
                        <th class="text-left" width="100px">Email</th>
                        <th class="text-left" width="100px">Numberphone</th>
                        <th class="text-left" width="90px">Telegram ID</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</section>
<?= $this->endSection() ?>
<?= $this->section('jscustom') ?>
<script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.23/datatables.min.js"></script>

<script>
    $(document).ready(function() {
    $('#tableAdmin').DataTable({
        processing: true,
        serverSide: true,
        ajax: '/cms/v1/list-admin',
        columns: [
            {data: 'username'},
            {data: 'fullName'},
            {data: 'email'},
            {data: 'numberPhone'},
            {data: 'TeleID'},
        ]
    });
});
</script>
<?= $this->endSection() ?>