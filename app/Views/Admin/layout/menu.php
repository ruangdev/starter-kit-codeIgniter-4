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
            <a href="" class='sidebar-link'>
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
                <li class="submenu-item ">
                    <a href="<?= route_to('admin.user')?>">
                        Data Admin
                    </a>
                </li>

                <li class="submenu-item ">
                    <a href="">
                        Data Role
                    </a>
                </li>

                <li class="submenu-item ">
                    <a href="">
                        Data Module
                    </a>
                </li>

                <li class="submenu-item ">
                    <a href="">
                        Data Permission
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</div>