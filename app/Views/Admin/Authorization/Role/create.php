<?= $this->extend('Admin/layout/app') ?>

<?= $this->section('csscustom') ?>

<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="page-title">

    <?php if (session()->has('errors')) : ?>
        <div class="alert alert-danger alert-dismissible show fade">
            <?= implode('<br>', session('errors')); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="row">

        <div class="col-12 col-md-8 order-md-1 order-first">
            <h4 class="card-title">
                Create Role
            </h4>
        </div>

        <div class="col-12 col-md-4 order-md-2 order-last">
            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="">Authorization</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Create Role</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<section class="section">
    <div class="card">
        <div class="card-body">
            <form class="form" action="<?= route_to('admin.role.store') ?>" method="POST">
                <?= csrf_field() ?>

                <div class="row">

                    <div class="col-12 d-flex justify-content-start">
                        <a href="<?= route_to('admin.role.list') ?>" class="btn btn-outline-secondary icon icon-left me-1 mb-1">
                            <i class="fas fa-arrow-alt-circle-left"></i>
                            Back
                        </a>
                        <button type="submit" class="btn btn-primary icon icon-left me-1 mb-1">
                            <i class="fas fa-plus-circle"></i>
                            Create
                        </button>
                    </div>

                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="role_name">Role Name</label>
                            <input type="text" id="role_name" class="form-control" placeholder="Role Name..." value="<?= old('role_name'); ?>" name="role_name" autofocus>
                        </div>
                    </div>

                    <div class="col-md-8 col-12">
                        <div class="form-group">
                            <label for="role_description">Role Description</label>
                            <textarea type="text" id="role_description" class="form-control" placeholder="Role Description..." name="role_description"><?= old('role_description'); ?></textarea>
                        </div>
                    </div>

                    <div class="col-md-12 col-12">
                        <div class="form-group">
                            <label for="permissions[]">
                                List Permission
                            </label>
                            <div class="row">
                                <?php foreach ($authorities as $authoritie) : ?>
                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <ul class="list-group me-1 mb-1">
                                                <li class="list-group-item text-black">
                                                    <?= esc($authoritie->module_name); ?>
                                                </li>

                                                <?php foreach ($authoritie->permissions as $permission) : ?>
                                                    <li class="list-group-item">
                                                        <div class="form-check form-switch">
                                                            <input id="permissions" name="permissions[]" class="form-check-input <?= isset($errors['permissions']) ? 'is-invalid' : ''; ?>" type="checkbox" value="<?= esc($permission->id); ?>" <?= in_array($permission->id, old('permissions') ?? []) ? 'checked' : ''; ?>>
                                                            <label class="form-check-label" for="<?= esc($permission->name); ?>">
                                                                <?= esc($permission->name); ?>
                                                            </label>

                                                            <?php if (isset($errors['permissions'])) : ?>
                                                                <div class="invalid-feedback">
                                                                    <?= esc($errors['permissions']); ?>
                                                                </div>
                                                            <?php endif; ?>
                                                        </div>
                                                    </li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<?= $this->endSection() ?>
<?= $this->section('jscustom') ?>

<?= $this->endSection() ?>