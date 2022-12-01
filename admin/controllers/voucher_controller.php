<?php
function voucher_index()
{
    $ctr = "voucher";
    $all = voucher_all();;
    $data = [
        'page_title' => 'Quản lý voucher',
        'ctr' => $ctr,
        'list' => $all,
    ];
    render('voucher.list', $data);
}

function voucher_create()
{
    $ctr = "voucher";
    $data = [
        'page_title' => 'Tạo voucher',
        'ctr' => $ctr,
    ];
    render('voucher.create', $data);
}

function voucher_store()
{
    $ctr = "voucher";
    if (isset($_POST['voucher_create'])) {
        $errors = [];
        extract($_POST);
        foreach ($_POST as $key => $field) {
            if ($key !== 'voucher_create' && $field === '') {
                $errors[$key][] = 'Vui lòng nhập trường này';
            }
        }

        if ($quantity <= 0) {
            $errors['quantity'][] = "Số voucher không được âm";
        }

        if ($discount <= 0 || $discount > 100) {
            $errors['discount'][] = 'Giá trị giảm giá không hợp lệ';
        }

        if (!empty($errors)) {
            session_set('errors', $errors);
            redirect([
                'ctr' => $ctr,
                'act' => 'create'
            ]);
            exit();
        }
//        echo "<pre>";
//        print_r($_POST);
//        echo "</pre>";
//        die();
        $voucherArr = generate_voucher_array($quantity, $status, $campaign_id, $discount);
        foreach ($voucherArr as $data) {
//            echo "<pre>";
//            print_r($data);
//            echo "</pre>";
//            die();
            $id = voucher_insert($data);
        }

        $status = [
            'type' => 'success',
            'title' => 'Thêm thành công',
        ];
        session_set('status', $status);
        redirect([
            'ctr' => $ctr,
        ]);
    }
}

function voucher_edit()
{
    $ctr = "voucher";
    if (!empty($_GET['id'])) {
        $id = $_GET['id'];
        $item = voucher_find($id);
        $data = [
            'page_title' => 'Sửa voucher',
            'ctr' => $ctr,
            'item' => $item,
        ];
        render('voucher.edit', $data);
    }
}

function voucher_update()
{
    $ctr = 'voucher';
    if (isset($_POST['voucher_edit'])) {
        $errors = [];
        extract($_POST);
        foreach ($_POST as $key => $field) {
            if ($key !== 'voucher_edit' && $field === '') {
                $errors[$key][] = 'Vui lòng nhập trường này';
            }
        }

        if ($discount <= 0 || $discount > 100) {
            $errors['discount'][] = 'Giá trị giảm giá không hợp lệ';
        }

        if (!empty($errors)) {
            session_set('errors', $errors);
            redirect([
                'ctr' => $ctr,
                'act' => 'edit',
                'id' => $id,
            ]);
            exit();
        }
        $data = [
            'discount' => $discount,
            'status' => $status,
            'campaign_id' => $campaign_id,
            'id' => $id,
        ];
        voucher_cap_nhat($data);
        $status = [
            'type' => 'success',
            'title' => 'Cập nhật thành công',
        ];
        session_set('status', $status);
        redirect([
            'ctr' => $ctr,
        ]);
    }
}

function voucher_delete()
{
    $ctr = 'voucher';
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $data = [
            'id' => $id,
        ];
        dich_vu_loai_phong_destroy_by_room_service_id(['room_service_id' => $id]);
        voucher_destroy($data);

        $status = [
            'type' => 'success',
            'title' => 'Xóa thành công',
        ];
        session_set('status', $status);
        redirect([
            'ctr' => $ctr
        ]);
    }
}

function create_voucher()
{
    $length = 10;
    $repeats = 5;
    $chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    return substr(str_shuffle(str_repeat($chars, $repeats)), 0, $length);
}

function generate_voucher_array($quantity, $status, $campaign_id, $discount)
{
    $voucherArr = [];
    while (count($voucherArr) < $quantity) {
        $voucher = create_voucher();
        if (!in_array($voucher, $voucherArr)) {
            $voucherArr[] = $voucher;
        }
    }
    $result = [];
    foreach ($voucherArr as $voucher) {
        $item = [
            'code' => $voucher,
            'status' => $status,
            'campaign_id' => $campaign_id,
            'discount' => $discount,
        ];
        $result[] = $item;
    }
    return $result;
}