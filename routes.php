<?php

// Lấy ctr và act từ url, nếu không sẽ set mặc định
$ctr = $_GET['ctr'] ?? 'home';
$act = $_GET['act'] ?? 'index';

switch ($ctr) {
    case 'home':
        switch ($act) {
            case 'index':
                show_home();
                break;
            case 'about':
                $act();
                break;
            default:
                show_notfound();
                break;
        }
        break;
    case 'auth':
        switch ($act) {
            case 'signup':
                signUp();
                break;
            case 'regist':
                handleRegist();
                break;
            case 'confirm_regist_code':
                confirmRegistCode();
                break;
            case 'signin':
                signIn();
                break;
            case 'process_signin':
                processSignIn();
                break;
            case 'info':
                userInfo();
                break;
            case 'update':
                userUpdate();
                break;
            case 'logout':
                userLogOut();
                break;
            default:
                show_notfound();
                break;
        }
        break;
    default:
        show_notfound();
        break;
}