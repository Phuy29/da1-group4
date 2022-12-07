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
            case 'services':
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
            case 'change_pass':
                change_pass_index();
                break;
            case 'check_change':
                change_pass_check();
                break;
            case 'confirm_change':
                confirmChangeCode();
                break;
            case 'forget':
                forget_index();
                break;
            case 'check_forget':
                forget_pass_check();
                break;
            case 'confirm_forget':
                confirmForgetCode();
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
    case 'loai_phong':
        switch ($act) {
            case 'index':
            case 'detail':
                $method = $ctr . '_' . $act;
                $method();
                break;
            default:
                show_notfound();
                break;
        }
        break;
    case 'dat_phong':
        switch ($act) {
            case 'check_available_home':
                checkAvailableRoom();
                break;
            case 'select_room':
                selectRoom();
                break;
            case 'confirm':
                confirmBooking();
                break;
            case 'confirm_booking':
                confirmBookingRoom();
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