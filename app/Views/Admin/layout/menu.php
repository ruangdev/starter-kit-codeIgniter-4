<div class="sidebar-menu">
    <div class="d-flex justify-content-center">
        <p class="text-mute">2022 &copy;
            <a href="https://zuramai.github.io/mazer/" target="_blank" rel="noopener noreferrer">Mazer</a>
            |
            <a href="http://" target="_blank" rel="noopener noreferrer">RuangDev IDN</a>
        </p>
    </div>

    <ul class="menu">
        <li class="sidebar-title">Main Menu</li>
        <li class="sidebar-item ">
            <a href="<?= route_to('admin.dashboard') ?>" class='sidebar-link'>
                <i class="fas fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li class="sidebar-item has-sub">
            <a href="#" class='sidebar-link'>
                <i class="fas fa-user-lock"></i>
                <span>Authentication</span>
            </a>
            <ul class="submenu ">
                <li class="submenu-item ">
                    <a href="">Google2FA</a>
                </li>
            </ul>
        </li>

        <li class="sidebar-item  has-sub">
            <a href="#" class='sidebar-link'>
                <i class="fas fa-folder"></i>
                <span>Authorization</span>
            </a>
            <ul class="submenu ">
                <?php if (has_permission('show.users')) : ?>
                    <li class="submenu-item">
                        <a href="<?= route_to('admin.user.list') ?>">
                            Data Admin
                        </a>
                    </li>
                <?php endif; ?>

                <li class="submenu-item">
                    <a href="<?= route_to('admin.role.create') ?>">
                        Data Role
                    </a>
                </li>

                <li class="submenu-item">
                    <a href="<?= route_to('admin.module.list') ?>">
                        Data Module
                    </a>
                </li>

                <li class="submenu-item">
                    <a href="<?= route_to('admin.permission.list') ?>">
                        Data Permission
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</div>