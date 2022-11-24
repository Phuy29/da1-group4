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
    case 'loai_phong':
        switch ($act) {
            case 'index':
                $method = $ctr . '_' . $act;
                $method();
                break;
            default:
                show_notfound(true);
                break;
        }
        break;
    case 'dich_vu_phong':
        switch ($act) {
            case 'index':
            case 'create':
            case 'store':
            case 'edit':
            case 'update':
            case 'delete':
                $method = $ctr . '_' . $act;
                $method();
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