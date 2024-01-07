<?= $this->extend('Admin/layout/app') ?>

<?= $this->section('csscustom') ?>

<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="page-title">

    <div class="row">
        <div class="col-12 col-md-8 order-md-1 order-first">
            <h4 class="card-title">
                View Role
            </h4>
        </div>

        <div class="col-12 col-md-4 order-md-2 order-last">
            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="">Authorization</a></li>
                    <li class="breadcrumb-item active" aria-current="page">View Role</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<section class="section">
    <div class="card">
        <div class="card-body">
                <div class="row">

                    <div class="col-12 d-flex justify-content-start">
                        <a href="<?= route_to('admin.role.list') ?>" class="btn btn-outline-secondary icon icon-left me-1 mb-1">
                            <i class="fas fa-arrow-alt-circle-left"></i>
                            Back
                        </a>
                    </div>

                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="role_name">Role Name</label>
                            <input type="text" id="role_name" class="form-control" placeholder="Role Name..." value="<?= old('role_name',$result->name); ?>"
                                    name="role_name" readonly>
                        </div>
                    </div>

                    <div class="col-md-8 col-12">
                        <div class="form-group">
                            <label for="role_description">Role Description</label>
                            <textarea type="text" id="role_description" class="form-control" placeholder="Role Description..."
                                    name="role_description" readonly><?= old('role_description',$result->description); ?></textarea>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>
<?= $this->section('jscustom') ?>

<?= $this->endSection() ?>