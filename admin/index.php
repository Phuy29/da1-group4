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
require_once '../libs/sendmail.php';

// include models
require_once '../models/connection.php';
require_once 'models/dich_vu_phong.php';


// include controllers
require_once '../controllers/base_controller.php';
require_once '../controllers/notfound_controller.php';
require_once 'controllers/dashboard_controller.php';
require_once 'controllers/loai_phong_controller.php';
require_once 'controllers/dich_vu_phong_controller.php';

// include routes
require_once('routes.php');