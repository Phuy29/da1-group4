<?php
function get_date($time)
{
    return date("H:i d/m/Y", strtotime($time));
}

function get_date_2($time)
{
    return date("d/m/Y", strtotime($time));
}

function get_price($price)
{
    return number_format((float)$price, 2, '.', '') . '$';
}

function deleteDirectory($dir)
{
    if (!file_exists($dir)) {
        return true;
    }

    if (!is_dir($dir)) {
        return unlink($dir);
    }

    foreach (scandir($dir) as $item) {
        if ($item == '.' || $item == '..') {
            continue;
        }

        if (!deleteDirectory($dir . DIRECTORY_SEPARATOR . $item)) {
            return false;
        }

    }

    return rmdir($dir);
}

function get_voucher_status($status)
{
    switch ($status) {
        case 0:
            return 'Đã hết hạn';
        case 1:
            return 'Vô hạn';
        default:
            return 'Hữu hạn';
    }
}

function to_slug($str)
{
    $str = trim(mb_strtolower($str));
    $str = preg_replace('/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/', 'a', $str);
    $str = preg_replace('/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/', 'e', $str);
    $str = preg_replace('/(ì|í|ị|ỉ|ĩ)/', 'i', $str);
    $str = preg_replace('/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/', 'o', $str);
    $str = preg_replace('/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/', 'u', $str);
    $str = preg_replace('/(ỳ|ý|ỵ|ỷ|ỹ)/', 'y', $str);
    $str = preg_replace('/(đ)/', 'd', $str);
    $str = preg_replace('/[^a-z0-9-\s]/', '', $str);
    $str = preg_replace('/([\s]+)/', '-', $str);
    return $str;
}

function redirect($data)
{
    if (!empty($data)) {
        if (is_array($data)) {
            $ctr = $data['ctr'] ?? 'dashboard';
            $act = $data['act'] ?? 'index';
            $path = "?ctr={$ctr}&act={$act}";
            if (!empty($data['id'])) {
                $path .= "&id={$data['id']}";
            }
        } else {
            $path = $data;
        }
        header("location: $path");
    }
}

function get_role($role)
{
    return match ($role) {
        1 => 'Nhân viên',
        2 => 'Quản lý',
        default => 'Khách',
    };
}

function get_date_range($checkin, $checkout)
{
    $checkin = str_replace('-', '/', date('d-m-Y', strtotime($checkin)));
    $checkout = str_replace('-', '/', date('d-m-Y', strtotime($checkout)));
    return $checkin . ' - ' . $checkout;
}

function limit_word($x, $length)
{
    if (mb_strlen($x, 'UTF-8') <= $length) {
        return $x;
    } else {
        $y = mb_substr($x, 0, $length, 'UTF-8') . '...';
        return $y;
    }
}

function get_day($start, $finish)
{
    return (strtotime($finish) - strtotime($start)) / (24 * 60 * 60);
}

function dd($data)
{
    if (is_array($data) || is_object($data)) {
        echo '<pre>';
        print_r($data);
        echo '</pre>';
    } else if (is_bool($data) || is_null($data)) {
        var_dump($data);
    } else {
        echo $data;
    }
    die();
}

function get_booking_status($status)
{
    $booking_status = _BOOKING_STATUS;
    return $booking_status[$status];
}