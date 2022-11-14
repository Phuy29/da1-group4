<?php

// Lấy ctr và act từ url, nếu không sẽ set mặc định
$ctr = $_GET['ctr'] ?? 'home';
$act = $_GET['act'] ?? 'index';
//die('Hello');
switch ($ctr) {
    case 'home':
        switch ($act) {
            case 'index':
                show_dashboard();
                break;
            default:
                show_notfound(true);
                break;
        }
        break;
    default:
        show_notfound(true);
        break;
}