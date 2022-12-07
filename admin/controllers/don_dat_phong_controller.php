<?php
function don_dat_phong_index()
{
    $ctr = "don_dat_phong";
    $all = chi_tiet_dat_phong_all();
    $data = [
        'page_title' => 'Quản lý đơn đặt phòng',
        'ctr' => $ctr,
        'list' => $all,
    ];
    render('don_dat_phong.list', $data);
}

function don_dat_phong_detail()
{
    $ctr = "don_dat_phong";
    if (!empty($_GET['id'])) {
        $id = $_GET['id'];
        $don = chi_tiet_dat_phong_find_by_booking_id($id);
        extract($don);
        $so_ngay = get_day($checkin, $checkout);
        $prices = $so_ngay * $price;
        $data = [
            'id' => $id,
            'fullname' => $fullname,
            'email' => $email,
            'phone_number' => $phone_number,
            'adults' => $adults,
            'children' => $children,
            'checkin' => $checkin,
            'checkout' => $checkout,
            'discount' => $discount,
            'total_price' => $total_price,
            'price' => $price,
            'so_ngay' => $so_ngay,
            'prices' => $prices,
            'room_name' => $room_name,
            'bookingStatus' => $status,
        ];
//        dd($data);
        $data['page_title'] = 'Đơn đặt phòng số ' . $id;
        $data['ctr'] = $ctr;
        render('don_dat_phong.detail', $data);
    }
}


function don_dat_phong_set_status()
{
    $ctr = 'don_dat_phong';
    if (isset($_POST['set_status_btn'])) {
        $id = $_POST['id'];
        $status = $_POST['status'];
        nguoi_dung_cap_nhat_trang_thai($status, $id);
        $statusName = get_booking_status($status);
        $statusSession = [
            'type' => 'success',
            'title' => 'Trạng thái của đơn có mã ' . $id . ' đã được chuyển thành "' . $statusName . '"',
        ];
        session_set('statusSession', $statusSession);
        $previous = $_SERVER['HTTP_REFERER'];
        redirect($previous);
    }
}

function don_dat_phong_set_active()
{
    $ctr = 'don_dat_phong';
    if (!empty($_GET['id'])) {
        $id = $_GET['id'];
        nguoi_dung_cap_nhat_trang_thai(1, $id);
        $status = [
            'type' => 'success',
            'title' => 'Đơn có mã ' . $id . ' đã được xác nhận',
        ];
        session_set('status', $status);
        redirect([
            'ctr' => $ctr,
        ]);
    }
}

function don_dat_phong_unset_active()
{
    $ctr = 'don_dat_phong';
    if (!empty($_GET['id'])) {
        $id = $_GET['id'];
        nguoi_dung_cap_nhat_trang_thai(0, $id);
        $status = [
            'type' => 'success',
            'title' => 'Trạng thái của đơn có mã ' . $id . ' đã chuyển thành chưa xác nhận',
        ];
        session_set('status', $status);
        redirect([
            'ctr' => $ctr,
        ]);
    }
}