<?php
session_start();

// include file config
require_once 'config/config.php';

// include PHPMailer
require 'public/PHPMailer/src/Exception.php';
require 'public/PHPMailer/src/PHPMailer.php';
require 'public/PHPMailer/src/SMTP.php';

// include library helper & session
require_once 'libs/helper.php';
require_once 'libs/session.php';
require_once 'libs/cookie.php';
require_once 'libs/sendmail.php';

// include model files
require_once 'models/connection.php';
require_once 'models/loai_giuong.php';
require_once 'models/anh_loai_phong.php';
require_once 'models/dich_vu_loai_phong.php';
require_once 'models/user.php';
require_once 'models/loai_phong.php';
require_once 'models/dat_phong.php';
require_once 'models/chi_tiet_dat_phong.php';
require_once 'models/voucher.php';
require_once 'models/voucher_da_dung.php';

// include controllers files
require_once 'controllers/base_controller.php';
require_once 'controllers/notfound_controller.php';
require_once 'controllers/home_controller.php';
require_once 'controllers/auth_controller.php';
require_once 'controllers/loai_phong_controller.php';
require_once 'controllers/dat_phong_controller.php';

// include file route
require_once('routes.php');