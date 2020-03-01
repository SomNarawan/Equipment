
    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-laugh-wink"></i>
            </div>
            <div class="sidebar-brand-text mx-3">ระบบยืม-คืน</div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item active">
            <a class="nav-link" href="#">
                <span>เจ้าหน้าที่</span></a>
        </li>
        <li class="nav-item active">
            <a class="nav-link" href="<?= Router::getSourcePath()."index.php?controller=Member&action=menu_type" ?>">
            <i class="fas fa-fw fa-cog"></i>
                <span>หมวดอุปกรณ์</span></a>
        </li>
        <li class="nav-item active">
            <a class="nav-link" href="<?= Router::getSourcePath()."index.php?controller=Member&action=menu_equipmentO" ?>">
            <i class="fas fa-fw fa-wrench"></i>
                <span>อุปกรณ์ทั้งหมด</span></a>
        </li>
        <li class="nav-item active">
            <a class="nav-link" href="<?= Router::getSourcePath()."index.php?controller=Member&action=menu_borrowingO" ?>">
            <i class="fas fa-fw fa-table"></i>
                <span>การยืม</span></a>
        </li>
        <li class="nav-item active">
            <a class="nav-link" href="<?= Router::getSourcePath()."index.php?controller=Member&action=menu_report" ?>">
            <i class="fas fa-fw fa-table"></i>
                <span>รายงานสถิติ</span></a>
        </li>
        <!-- ----------------------------------------------- -->
        <li class="nav-item active">
            <a class="nav-link" href="#">
                <span>นิสิต-อาจารย์</span></a>
        </li>
        <li class="nav-item active">
            <a class="nav-link" href="<?= Router::getSourcePath()."index.php?controller=Member&action=menu_equipmentST" ?>">
            <i class="fas fa-fw fa-wrench"></i>
                <span>อุปกรณ์ทั้งหมด</span></a>
        </li>
        <li class="nav-item active">
            <a class="nav-link" href="<?= Router::getSourcePath()."index.php?controller=Member&action=menu_borrowingST" ?>">
            <i class="fas fa-fw fa-table"></i>
                <span>การยืม</span></a>
        </li>
        <li class="nav-item active">
            <a class="nav-link" href="<?= Router::getSourcePath()."index.php?controller=Member&action=menu_confirm" ?>">
            <i class="fas fa-fw fa-table"></i>
                <span>คำร้อง</span></a>
        </li>
        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>

                <!-- Topbar Search -->
                <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                    <div class="input-group">
                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                            aria-label="Search" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </form>

                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">
                    
                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                <?php
                                if (isset($_SESSION["member"]) && $_SESSION["member"] != "")
                                {
                                    $member = $_SESSION['member'];
                                //    print_r($member);
                                    echo "<div>{$member->getName()} {$member->getSurname()} </div>";
                                }
                                ?>
                                

                            </span>
                            <i class='fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400' title="Logout"
                                    href=".Router::getSourcePath()."index.php?controller=Member&action=logout></i>
                                    
                            <!-- <img class="img-profile rounded-circle" src="https://source.unsplash.com/QAB-WJcbgJk/60x60"> -->
                        </a>
                       
                    </li>

                </ul>

            </nav>
            <!-- End of Topbar -->
            <?php
/*echo "<hr/>";
echo "<pre><code>";
show_source(__FILE__);
echo "</code></pre>";*/