<?= $this->extend('Admin/layout/app') ?>

<?= $this->section('csscustom') ?>
<link rel="stylesheet" href="<?= base_url('assets/cms/css/choices.css') ?>">
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
                Edit Permission
            </h4>
        </div>

        <div class="col-12 col-md-4 order-md-2 order-last">
            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="">Authorization</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Permission</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<section class="section">
    <div class="card">
        <div class="card-body">
            <form class="form" action="<?= route_to('admin.permission.update', $result->uuid) ?>" method="POST">
                <?= csrf_field() ?>
                <input type="hidden" name="_method" value="PUT">

                <div class="row">

                    <div class="col-12 d-flex justify-content-start">
                        <a href="<?= route_to('admin.permission.list') ?>" class="btn btn-outline-secondary icon icon-left me-1 mb-1">
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
                            <label for="permissionName">Permission Name</label>
                            <input type="text" id="permissionName" class="form-control" placeholder="Permission Name..." value="<?= old('permissionName', $result->name); ?>" name="permissionName" autofocus>
                        </div>
                    </div>

                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="permissionDescription">Permission Description</label>
                            <input type="text" id="permissionDescription" class="form-control" placeholder="Permission Description..." value="<?= old('permissionDescription', $result->description); ?>" name="permissionDescription">
                        </div>
                    </div>

                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="module">Module</label>
                            <select class="form-select" id="module" name="module">
                                <option value="" selected>Choose Module</option>
                                <?php foreach ($modules as $module) : ?>
                                    <?php if (old('module') == $module->id) : ?>
                                        <option value="<?= esc($module->id) ?>" selected>
                                            <?= esc($module->module_name) ?>
                                        </option>
                                    <?php else : ?>
                                        <?php if ($result->id_auth_module == $module->id) : ?>
                                            <option value="<?= esc($module->id) ?>" selected>
                                                <?= esc($module->module_name) ?>
                                            </option>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<?= $this->endSection() ?>
<?= $this->section('jscustom') ?>
<script src="<?= base_url('assets/cms/js/choices.js') ?>"></script>
<script>
    let choices = document.querySelectorAll('#module')
    let initChoice
    for (let i = 0; i < choices.length; i++) {
        initChoice = new Choices(choices[i])
    }
</script>
<?= $this->endSection() ?>