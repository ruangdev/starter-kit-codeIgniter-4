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
                Edit Role
            </h4>
        </div>

        <div class="col-12 col-md-4 order-md-2 order-last">
            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="">Authorization</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Role</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<section class="section">
    <div class="card">
        <div class="card-body">
            <form class="form" action="<?= route_to('admin.role.update', $result->uuid) ?>" method="POST">
                <?= csrf_field() ?>
                <input type="hidden" name="_method" value="PUT">

                <div class="row">

                    <div class="col-12 d-flex justify-content-start">
                        <a href="<?= route_to('admin.role.list') ?>" class="btn btn-outline-secondary icon icon-left me-1 mb-1">
                            <i class="fas fa-arrow-alt-circle-left"></i>
                            Back
                        </a>
                        <button type="submit" class="btn btn-primary icon icon-left me-1 mb-1">
                            <i class="fas fa-edit"></i>
                            Edit
                        </button>
                    </div>

                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="role_name">Role Name</label>
                            <input type="text" id="role_name" class="form-control" placeholder="Role Name..." value="<?= old('role_name', $result->name); ?>" name="role_name" autofocus>
                        </div>
                    </div>

                    <div class="col-md-8 col-12">
                        <div class="form-group">
                            <label for="role_description">Role Description</label>
                            <textarea type="text" id="role_description" class="form-control" placeholder="Role Description..." name="role_description"><?= old('role_description', $result->description); ?></textarea>
                        </div>
                    </div>

                    <div class="col-md-12 col-12">
                        <div class="form-group">
                            <label for="permissions[]">List Permission</label>
                            <div class="row">
                                <?php foreach ($authorities as $authority) : ?>
                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <ul class="list-group ml-1 mb-2">
                                                <li class="list-group-item text-black">
                                                    <?= esc($authority->module_name) ?>
                                                </li>
                                                <?php foreach ($authority->permissions as $permission) : ?>
                                                    <li class="list-group-item">
                                                        <div class="form-check form-switch">
                                                            <?php
                                                            $isChecked = false;
                                                            if (isset($findPermission) && is_array($findPermission) && in_array($permission->id, array_column($findPermission, 'permission_id'))) {
                                                                $isChecked = true;
                                                            }
                                                            ?>
                                                            <input id="permission_<?= esc($permission->id) ?>" name="permissions[]" class="form-check-input <?= isset($errors['permissions']) ? 'is-invalid' : '' ?>" type="checkbox" value="<?= esc($permission->id) ?>" <?= (is_array(old('permissions')) && in_array($permission->id, old('permissions'))) || $isChecked ? 'checked' : '' ?>>
                                                            <label class="form-check-label" for="permission_<?= esc($permission->id) ?>">
                                                                <?= esc($permission->name) ?>
                                                            </label>
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