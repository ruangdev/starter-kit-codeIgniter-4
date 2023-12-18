<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Ruang Dev</title>

    <link rel="stylesheet" href="<?= base_url('assets/cms/css/app.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/cms/css/app-dark.css') ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="shortcut icon" href="https://laravel.com/img/notification-logo.png" type="image/png">
    
    <?= $this->renderSection('csscustom') ?>
</head>

<body>
    <div id="app">

        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">

                <!-- Header -->
                <?= $this->include('Admin/layout/header') ?>
                <!-- End Header -->

                <!-- Menu -->
                <?= $this->include('Admin/layout/menu') ?>
                <!-- End Menu -->

            </div>
        </div>

        <div id="main" class='layout-navbar'>

            <!-- Navbar -->
            <?= $this->include('Admin/layout/navbar') ?>
            <!-- End Navbar -->

            <div id="main-content">
                <div class="page-heading">
                    <!-- Contain -->
                    <?= $this->renderSection('content') ?>
                    <!-- End Contain -->
                </div>
            </div>

        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js" integrity="sha512-Tn2m0TIpgVyTzzvmxLNuqbSJH3JP8jm+Cy3hvHrW7ndTDcJ1w5mBiksqDBb8GpE2ksktFvDB/ykZ0mDpsZj20w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="<?= base_url('assets/cms/js/bootstrap.js') ?>"></script>
    <script src="<?= base_url('assets/cms/js/app.js') ?>"></script>
    <?= $this->renderSection('jscustom') ?>
</body>
</html>