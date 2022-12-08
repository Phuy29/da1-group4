<?php

// Hàm hiển thị ra trang dashboard của admin
function show_dashboard()
{
    $ctr = 'home';
    $bookingAll = chi_tiet_dat_phong_all();
    $phong = loai_phong_all();
    $phongArr = [];
    foreach ($phong as $p) {
        $room_id = $p['id'];
        $phongArr[$room_id] = $p;
    }
    $bookingFil = array_filter($bookingAll, function ($booking) {
        return $booking['status'] != -1;
    });
    $bookingUnActive = array_filter($bookingAll, function ($booking) {
        return $booking['status'] == 0;
    });
    $bookingActive = array_filter($bookingAll, function ($booking) {
        return $booking['status'] == 1;
    });
    $tongDoanhThu = array_reduce($bookingFil, function ($result, $booking) {
        return $result + $booking['total_price'];
    }, 0);
    $tongSoDonDat = count($bookingAll);
    $soDonChuaXacNhan = count($bookingUnActive);
    $soDonDaXacNhan = count($bookingActive);
    $tongSoDonBiHuy = $tongSoDonDat - $soDonChuaXacNhan - $soDonDaXacNhan;
    foreach ($bookingAll as $booking) {
        $room_id = $booking['room_id'];
        if (!empty($phongArr[$room_id]['so_luot_dat'])) {
            $phongArr[$room_id]['so_luot_dat']++;
        } else {
            $phongArr[$room_id]['so_luot_dat'] = 1;
        }
    }
    foreach ($bookingFil as $booking) {
        $room_id = $booking['room_id'];
        if (!empty($phongArr[$room_id]['doanh_thu'])) {
            $phongArr[$room_id]['doanh_thu'] += $booking['total_price'];
        } else {
            $phongArr[$room_id]['doanh_thu'] = $booking['total_price'];
        }
    }

    $soPhong = count($phong);
    $soChienDich = count(chien_dich_all());
    $soVoucher = count(voucher_all());
    $soDichVuPhong = count(dich_vu_phong_all());
    $nguoiDung = nguoi_dung_all();
    $soNguoiDung = 0;
    foreach ($nguoiDung as $user) {
        if ($user['role'] == 0) {
            $soNguoiDung++;
        }
    }


    $data = [
        'page_title' => 'Dashboard',
        'ctr' => $ctr,
        'tongDoanhThu' => $tongDoanhThu,
        'tongSoDon' => $tongSoDonDat,
        'soDonBiHuy' => $tongSoDonBiHuy,
        'soDonChuaXacNhan' => $soDonChuaXacNhan,
        'soDonDaXacNhan' => $soDonDaXacNhan,
        'phong' => $phongArr,
        'soPhong' => $soPhong,
        'soChienDich' => $soChienDich,
        'soVoucher' => $soVoucher,
        'soDichVuPhong' => $soDichVuPhong,
        'soNguoiDung' => $soNguoiDung,
    ];
    render('dashboard', $data);
}