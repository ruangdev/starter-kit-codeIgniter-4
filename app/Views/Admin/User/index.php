<?= $this->extend('Admin/layout/app') ?>

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
                    <li class="breadcrumb-item"><a href="index.html">Authorization</a></li>
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
                        <th class="text-center" width="100px">Action</th>
                        <th class="text-left" width="20px">No.</th>
                        <th class="text-left" width="100px">Username</th>
                        <th class="text-left" width="100px">Full Name</th>
                        <th class="text-left" width="100px">Email</th>
                        <th class="text-left" width="260px">Role</th>
                        <th class="text-left" width="100px">Numberphone</th>
                        <th class="text-left" width="90px">Telegram ID</th>
                        <th class="text-left" width="110px">Created</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</section>
<?= $this->endSection() ?>