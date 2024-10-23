<?php
echo'
<header id="page-topbar">
    <div class="layout-width">
        <div class="navbar-header">
            <div class="d-flex">
                <div class="navbar-brand-box horizontal-logo">
                    <a href="dashboard.php" class="logo logo-dark">
                        <span class="logo-sm">
                            <img src="'.SITE_URL.'/images/logo.png" alt="" height="50">
                        </span>
                        <span class="logo-lg">
                            <img src="'.SITE_URL.'/images/logo.png" alt="" height="40">
                        </span>
                    </a>
                    <a href="dashboard.php" class="logo logo-light">
                        <span class="logo-sm">
                            <img src="'.SITE_URL.'/images/logo.png" alt="" height="50">
                        </span>
                        <span class="logo-lg">
                            <img src="'.SITE_URL.'/images/logo.png" alt="" height="40">
                        </span>
                    </a>
                </div>

                <button type="button" class="btn btn-sm px-3 fs-16 header-item vertical-menu-btn topnav-hamburger" id="topnav-hamburger-icon">
                    <span class="hamburger-icon">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                </button>
            </div>

            <div class="d-flex align-items-center">

                <div class="ms-1 header-item d-none d-sm-flex">
                    <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle" data-toggle="fullscreen">
                        <i class="bx bx-fullscreen fs-22"></i>
                    </button>
                </div>

                <div class="ms-1 header-item d-none d-sm-flex">
                    <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle light-dark-mode">
                        <i class="bx bx-moon fs-22"></i>
                    </button>
                </div>

                <div class="dropdown ms-sm-3 header-item topbar-user">
                    <button type="button" class="btn" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="d-flex align-items-center">
                            <img class="rounded-circle header-profile-user" src="'.SITE_URL.'/images/admin/'.$_SESSION['userlogininfo']['LOGINPHOTO'].'" alt="Header Avatar">
                            <span class="text-start ms-xl-2">
                                <span class="d-none d-xl-inline-block ms-1 fw-medium user-name-text">'.$_SESSION['userlogininfo']['LOGINNAME'].'</span>
                                <span class="d-none d-xl-block ms-1 fs-12 text-muted user-name-sub-text">'.get_admtypes($_SESSION['userlogininfo']['LOGINTYPE']).'</span>
                            </span>
                        </span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <h6 class="dropdown-header">Welcome !</h6>
                        <a class="dropdown-item" href="profile.php"><i class="mdi mdi-account-circle text-muted fs-16 align-middle me-1"></i> <span class="align-middle">Profile</span></a>
                        <a class="dropdown-item" href="index.php?logout"><i class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i> <span class="align-middle" data-key="t-logout">Logout</span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>';
?>