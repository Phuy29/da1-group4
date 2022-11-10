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
    default:
        show_notfound();
        break;
}