<?php
if (!empty(session_get('user_session'))) {
    $user_session = session_get('user_session');
}
?>
<!doctype html>
<html class="no-js" lang="zxx">

<!-- Mirrored from zcube.in/riorelax/ by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 03 Nov 2022 03:42:45 GMT -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?= $page_title ?? 'Document' ?></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="public/img/favicon.ico">
    <!-- Place favicon.ico in the root directory -->

    <link rel="stylesheet" href="public/admin/dist/assets/css/main/app.css">
    <!-- CSS here -->
    <link rel="stylesheet" href="public/css/bootstrap.min.css">
    <link rel="stylesheet" href="public/css/animate.min.css">
    <link rel="stylesheet" href="public/css/magnific-popup.css">
    <link rel="stylesheet" href="public/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="public/css/dripicons.css">
    <link rel="stylesheet" href="public/css/slick.css">
    <link rel="stylesheet" href="public/css/meanmenu.css">
    <link rel="stylesheet" href="public/css/default.css">
    <link rel="stylesheet" href="public/css/style.css">
    <link rel="stylesheet" href="public/css/responsive.css">
    <link rel="stylesheet" href="public/admin/dist/assets/css/pages/auth.css">
    <link
            rel="stylesheet"
            href="public/admin/dist/assets/extensions/sweetalert2/sweetalert2.min.css"
    />

    <script src="public/js/vendor/jquery-3.6.0.min.js"></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/additional-methods.min.js"></script>
    <style>
        label.error {
            color: rgb(220 53 69) !important;
        }
    </style>
</head>
<body>
<!-- header -->
<header class="header-area header-three">
    <div class="header-top second-header d-none d-md-block">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8 col-md-10 d-none d-lg-block">
                    <div class="header-cta">
                        <ul>
                            <li>
                                <i class="far fa-clock"></i>
                                <span>9:00 - 19:00 / Vào tất cả các ngày trong tuần</span>
                            </li>
                            <li>
                                <i class="far fa-mobile"></i>
                                <strong>0123.456.789</strong>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-4 col-md-2 d-none d-lg-block text-right">
                    <?php if (!empty($user_session)): ?>
                        <p class="m-0">Xin chào <a class="text-decoration-underline"
                                                   href="?ctr=auth&act=info"><?= $user_session['fullname'] ?></a></p>
                        <div>
                            <?php if ($user_session['role'] != 0): ?>
                                <a class="py-1 px-2 mt-2 rounded btn-secondary" href="admin">Trang quản trị</a>
                            <?php endif; ?>
                            <a class="py-1 px-2 mt-2 rounded btn-danger" href="?ctr=auth&act=logout">Đăng xuất</a>
                        </div>
                    <?php else: ?>
                        <a href="?ctr=auth&act=signin" class="btn rounded p-2 me-2">Đăng nhập</a>
                        <a href="?ctr=auth&act=signup" class="btn btn-secondary rounded p-2"
                           style="background: #6c757d;">Đăng ký</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <div id="header-sticky" class="menu-area">
        <div class="container">
            <div class="second-menu">
                <div class="row align-items-center">
                    <div class="col-xl-2 col-lg-2">
                        <div class="logo">
                            <a href="<?= _BASE_URL ?>"><img src="public/img/logo/logo.png" alt="logo"></a>
                        </div>
                    </div>
                    <div class="col-xl-8 col-lg-8">

                        <div class="main-menu text-center">
                            <nav id="mobile-menu">
                                <ul>
                                    <li><a href="<?= _BASE_URL ?>">TRANG CHỦ</a></li>
                                    <li><a href="?act=about">GIỚI THIỆU</a></li>
                                    <li class="">
                                        <a href="?ctr=loai_phong">DANH SÁCH LOẠI PHÒNG</a>
                                    </li>
                                    <li class="">
                                        <a href="?act=services">DỊCH VỤ</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-2 d-none d-lg-block">
                        <a href="?ctr=dat_phong&act=check_available_home" class="top-btn mt-10 mb-10">Tìm phòng </a>
                    </div>

                    <div class="col-12">
                        <div class="mobile-menu"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- header-end -->