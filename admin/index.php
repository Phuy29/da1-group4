<?php

session_start();

// include file config
require_once '../config/config.php';

// include library helper & session
require_once '../lib/helper.php';
require_once '../lib/session.php';

// include model files
require_once '../models/connection.php';


// include controllers files
require_once '../controllers/base_controller.php';
require_once '../controllers/notfound_controller.php';
require_once '../controllers/home_controller.php';

// include file route
require_once('routes.php');