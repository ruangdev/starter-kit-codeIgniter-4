<?= $this->extend('Admin/layout/app') ?>

<?= $this->section('csscustom') ?>

<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="page-title">
    <div class="row">

        <div class="col-12 col-md-8 order-md-1 order-first">
            <h4 class="card-title">
                Create Admin
            </h4>
        </div>

        <div class="col-12 col-md-4 order-md-2 order-last">
            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="">Authorization</a></li>
                    <li class="breadcrumb-item"><a href="">List Admin</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Create Admin</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<section class="section">
    <div class="card">
        <div class="card-body">
        <form class="form" action="" method="POST">

                    <div class="row">

                        <div class="col-12 d-flex justify-content-start">
                            <a href="<?= route_to('admin.user.list') ?>" class="btn btn-outline-secondary icon icon-left me-1 mb-1">
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
                                <label for="fullName">Full Name</label>
                                <input type="text" id="fullName" class="form-control"
                                    placeholder="Full Name..." name="fullName" autofocus>
                            </div>
                        </div>

                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="name">Username</label>
                                <input type="text" id="name" class="form-control"
                                    placeholder="Username..." name="name">
                            </div>
                        </div>

                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" id="email" class="form-control" placeholder="Email..." name="email">
                            </div>
                        </div>

                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="telegramid">Telegram ID</label>
                                <input type="text" id="telegramid" class="form-control"
                                    name="telegramid" placeholder="Telegram ID...">
                            </div>
                        </div>
                        
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="Numberphone">Numberphone</label>
                                <input type="text" id="Numberphone" class="form-control"
                                    name="Numberphone" placeholder="Numberphone...">
                            </div>
                        </div>

                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="password">Password</label>
                                <div class="input-group mb-3">
                                        <input type="password" name="password" id="password" class="form-control" placeholder="Password...">
                                        <button class="btn btn-primary" type="button" onclick="showPassword()">
                                            show
                                        </button>
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