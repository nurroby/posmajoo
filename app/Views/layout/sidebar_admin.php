<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-no-expand sidebar-light sidebar-light-teal majoo-bg">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="https://majoo.id/assets/img/main-logo.png" alt="AdminLTE Logo" class="brand-image elevation-1" style="opacity: .8">
        <span class="brand-text font-weight-light">Admin</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="info">
                <a href="#" class="d-block"></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="<?= base_url() ?>/admin" class="nav-link">
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-header">MASTER DATA</li>
                <li class="nav-item">
                    <a href="<?= base_url() ?>/admin/category" class="nav-link">
                        <i class="nav-icon fas fa-tag"></i>
                        <p>
                            Master Categories
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url() ?>/admin/product" class="nav-link"">
                        <i class="nav-icon fas fa-box"></i>
                        <p>
                            Master Products
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link" style="cursor:not-allowed" onclick="maintenance();">
                        <i class="nav-icon fas fa-address-book"></i>
                        <p>
                            Master Users
                        </p>
                    </a>
                </li>
                <li class="nav-header">TRANSAKSI</li>
                <li class="nav-item">
                    <a href="#" class="nav-link" style="cursor:not-allowed" onclick="maintenance();">
                        <i class="fas fa-shopping-basket nav-icon"></i>
                        <p>Orders</p>
                    </a>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>