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
                Create Module
            </h4>
        </div>

        <div class="col-12 col-md-4 order-md-2 order-last">
            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="">Authorization</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Create Module</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<section class="section">
    <div class="card">
        <div class="card-body">
            <form class="form" action="" method="POST">
                <?= csrf_field() ?>

                <div class="row">

                    <div class="col-12 d-flex justify-content-start">
                        <a href="<?= route_to('admin.module.list') ?>" class="btn btn-outline-secondary icon icon-left me-1 mb-1">
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
                            <label for="module">Module</label>
                            <input type="text" id="module" class="form-control" placeholder="Module..." value="<?= old('module'); ?>"
                                    name="module" autofocus>
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