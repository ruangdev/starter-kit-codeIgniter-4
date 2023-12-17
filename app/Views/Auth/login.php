<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        System Auth CMS | RuangDev
    </title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="<?= base_url('assets/auth/css/boxicons.css') ?>">

    <!-- Core CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/auth/css/core.css') ?>" class="template-customizer-core-css" />
    <link rel="stylesheet" href="<?= base_url('assets/auth/css/theme-default.css') ?>" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="<?= base_url('assets/auth/css/demo.css') ?>" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/auth/css/perfect-scrollbar.css') ?>" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Page CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/auth/css/page-auth.css') ?>" />
    <script src="<?= base_url('assets/auth/js/helpers.js') ?>"></script>
    <script src="<?= base_url('assets/auth/js/config.js') ?>"></script>
</head>

<body>
    <!-- Content -->
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">
                <div class="card">
                    <div class="d-flex justify-content-center mt-3">
                        <h4>
                            System Auth CMS
                        </h4>
                    </div>
                    <div class="card-body shadow rounded">
                        <div class="d-flex justify-content-center">
                            <img class="rounded-circle app-brand-size-logo" src="<?= base_url('assets/auth/image/logo.png') ?>">
                        </div>

                        <form id="formAuthentication" class="mb-3" method="POST" action="<?= url_to('login') ?>">
                        <?= csrf_field() ?>

                            <div class="mb-3">
                                <label for="name" class="form-label">Username</label>
                                <input type="text" class="form-control" id="name" name="login" placeholder="Enter your username" utocomplete="off" required autofocus />
                            </div>

                            <div class="mb-3 form-password-toggle">
                                <label class="form-label" for="password">Password</label>
                                <div class="input-group input-group-merge">
                                    <input id="password" type="password" class="form-control" name="password" required autocomplete="off" placeholder="Password" aria-describedby="password">

                                    <span class="input-group-text cursor-pointer">
                                        <div class="hide-show">
                                            <span>Show</span>
                                        </div>
                                    </span>
                                </div>
                            </div>

                            <div class="mb-2">
                                <img src="<?= $codecap; ?>" />
                            </div>

                            <div class="mb-2">
                                <label for="name" class="form-label">Capcha</label>
                                <input type="text" class="form-control" id="capcha" name="capcha" placeholder="Enter Capcha..." utocomplete="off"/>
                            </div>

                            <div class="mb-1">
                                <label style="color:#a0a9b4">Don't have account yet?</label>
                                <span style="width:5px;">&nbsp;</span>
                                <a style="font-weight:600" href="<?= url_to('register') ?>">Register here.</a>
                            </div>

                            <div class="mb-3">
                                <label style="color:#a0a9b4">Back</label>
                                <a style="font-weight:600" href="<?= url_to('home.site') ?>">Website.</a>
                            </div>

                            <div class="mb-3">
                                <button class="btn btn-primary d-grid w-100 my-1" type="submit">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js" integrity="sha512-Tn2m0TIpgVyTzzvmxLNuqbSJH3JP8jm+Cy3hvHrW7ndTDcJ1w5mBiksqDBb8GpE2ksktFvDB/ykZ0mDpsZj20w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="<?= base_url('assets/auth/js/jquery.js') ?>"></script>
    <script src="<?= base_url('assets/auth/js/popper.js') ?>"></script>
    <script src="<?= base_url('assets/auth/js/bootstrap.js') ?>"></script>
    <script src="<?= base_url('assets/auth/js/perfect-scrollbar.js') ?>"></script>
    <script src="<?= base_url('assets/auth/js/menu.js') ?>"></script>
    <script src="<?= base_url('assets/auth/js/password.js') ?>"></script>
    <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>

</html>