<?= $this->extend('Admin/layout/app') ?>

<?= $this->section('csscustom') ?>
<link href="https://cdn.datatables.net/v/bs5/jq-3.7.0/dt-1.13.8/datatables.css" rel="stylesheet">
<link rel="stylesheet" href="<?= base_url('assets/cms/css/sweetalert/sweetalert.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets/cms/css/toastify.css') ?>">
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="page-title">
    <div class="row">
        <div class="col-12 col-md-4 order-md-1 order-last">
            <a href="<?= route_to('admin.user.create') ?>" class="btn btn-primary">
                <i class="fas fa-folder-plus"></i>
                Create
            </a>
        </div>

        <div class="col-12 col-md-4 order-md-1 order-first">
            <h4 class="card-title">
                List Data User
            </h4>
        </div>

        <div class="col-12 col-md-4 order-md-2 order-last">
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
        <div class="card-body table-responsive">
            <table class="table table-hover table-striped" id="tableAdmin">
                <thead class="table-dark">
                    <tr>
                        <th class="text-left" width="50px">No.</th>
                        <th class="text-left" width="100px">Username</th>
                        <th class="text-left" width="100px">Full Name</th>
                        <th class="text-left" width="50px">Status</th>
                        <th class="text-left" width="100px">Email</th>
                        <th class="text-left" width="100px">Numberphone</th>
                        <th class="text-left" width="100px">Telegram ID</th>
                        <th class="text-left" width="100px">Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</section>
<?= $this->endSection() ?>
<?= $this->section('jscustom') ?>
<script src="<?= base_url('assets/cms/js/jquery.min.js') ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.23/datatables.min.js"></script>
<script src="<?= base_url('assets/cms/js/sweetalert/sweetalert.js') ?>"></script>

<?= $this->include('Admin/User/datatable/index'); ?>
<?= $this->include('Admin/User/js/trash'); ?>
<?= $this->include('Admin/User/js/status'); ?>
<?= $this->endSection(); ?>

<?= $this->section('jscustom') ?>
<script src="<?= base_url('assets/cms/js/toastify.js') ?>"></script>
<?php if (session()->has('message')) : ?>
    <?= $this->include('Admin/layout/notif') ?>
<?php endif; ?>
<?= $this->endSection('jscustom') ?>