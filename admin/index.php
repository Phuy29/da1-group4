<?php

session_start();

// include file config
require_once '../config/config.php';

// include PHPMailer
require '../public/PHPMailer/src/Exception.php';
require '../public/PHPMailer/src/PHPMailer.php';
require '../public/PHPMailer/src/SMTP.php';

// include libraries
require_once '../libs/helper.php';
require_once '../libs/session.php';
require_once '../libs/cookie.php';
require_once '../libs/sendmail.php';

// include models
require_once '../models/connection.php';
require_once '../models/loai_giuong.php';
require_once '../models/anh_loai_phong.php';
require_once '../models/dich_vu_loai_phong.php';
require_once 'models/loai_phong.php';
require_once 'models/dich_vu_phong.php';
require_once 'models/chien_dich.php';
require_once 'models/voucher.php';
require_once 'models/don_dat_phong.php';
require_once 'models/chi_tiet_dat_phong.php';
require_once 'models/nguoi_dung.php';


// include controllers
require_once '../controllers/base_controller.php';
require_once 'controllers/loai_phong_controller.php';
require_once '../controllers/notfound_controller.php';
require_once 'controllers/dashboard_controller.php';
require_once 'controllers/dich_vu_phong_controller.php';
require_once 'controllers/chien_dich_controller.php';
require_once 'controllers/voucher_controller.php';
require_once 'controllers/don_dat_phong_controller.php';
require_once 'controllers/nguoi_dung_controller.php';
require_once 'controllers/thong_ke_controller.php';

if (empty(session_get('user_session')) || session_get('user_session')['role'] == 0) {
    redirect(_BASE_URL);
}

// include routes
require_once('routes.php');

