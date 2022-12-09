<?php
function voucher_index()
{
    $ctr = "voucher";
    $all = voucher_all();
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
    $campaigns = chien_dich_all();
    $data = [
        'page_title' => 'Tạo voucher',
        'ctr' => $ctr,
        'campaigns' => $campaigns,
    ];
    render('voucher.create', $data);
}

function voucher_store()
{
    $ctr = "voucher";
    if (isset($_POST['voucher_create'])) {
        $errors = [];
        foreach ($_POST as $key => $field) {
            if ($key !== 'voucher_create' && $field === '') {
                $errors[$key][] = 'Vui lòng nhập trường này';
            }
        }

        if ($_POST['max'] <= 0) {
            $errors['max'][] = 'Lượt nhập tối đa không được nhỏ hơn 1';
        }

        if (!empty($errors)) {
            session_set('errors', $errors);
            redirect([
                'ctr' => $ctr,
                'act' => 'create'
            ]);
            exit();
        }
        $voucherAll = voucher_all();
        $voucherArr = array_map(function ($voucher) {
            return $voucher['code'];
        }, $voucherAll);
        do {
            $voucher = create_voucher();
        } while (in_array($voucher, $voucherArr));
        $max = $_POST['max'] ?? null;
        $discount = $_POST['discount'];
        $status = $_POST['status'];
        $campaign_id = $_POST['campaign_id'];
        $data = [
            'code' => $voucher,
            'discount' => $discount,
            'campaign_id' => $campaign_id,
            'status' => $status,
            'max' => $max,
        ];
        $id = voucher_insert($data);

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
        $campaigns = chien_dich_all();
        $data = [
            'page_title' => 'Sửa voucher',
            'ctr' => $ctr,
            'item' => $item,
            'campaigns' => $campaigns,
        ];
        render('voucher.edit', $data);
    }
}

function voucher_update()
{
    $ctr = 'voucher';
    if (isset($_POST['voucher_edit'])) {
        $errors = [];
        $id = $_POST['id'];
        $discount = $_POST['discount'];
        $status = $_POST['status'];
        $max = $_POST['max'] ?? null;
        $campaign_id = $_POST['campaign_id'];
        foreach ($_POST as $key => $field) {
            if ($key !== 'voucher_edit' && $field === '') {
                $errors[$key][] = 'Vui lòng nhập trường này';
            }
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
            'max' => $max,
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

function voucher_send()
{
    $ctr = 'voucher';
    if (!empty($_GET['id'])) {
        $id = $_GET['id'];
        $voucher = voucher_find($id);
        $bookingArr = don_dat_phong_all();
        $bookingEmail = array_map(function ($booking) {
            return $booking['email'];
        }, $bookingArr);
        $bookingEmail = array_unique($bookingEmail);
        $data = [
            'ctr' => $ctr,
            'page_title' => 'Gửi ưu đãi',
            'emails' => $bookingEmail,
            'voucher' => $voucher,
        ];
        render('voucher.send', $data);
    }
}

function voucher_process_send()
{
    $ctr = 'voucher';
    if (isset($_POST['voucher_send_btn'])) {
        $errors = [];
        extract($_POST);
        foreach ($_POST as $key => $field) {
            if ($key !== 'voucher_send_btn' && $field === '') {
                $errors[$key][] = 'Vui lòng nhập trường này';
            }
        }
        if (!empty($errors)) {
            session_set('errors', $errors);
            redirect([
                'ctr' => $ctr,
                'act' => 'send'
            ]);
            exit();
        }
        $content .= '<h3>Mã: ' . $code . '</h3>';

        if ($send_to === 'all') {
            $bookingArr = don_dat_phong_all();
            $bookingEmail = array_map(function ($booking) {
                return $booking['email'];
            }, $bookingArr);
            $bookingEmail = array_unique($bookingEmail);
            sendmailBCC($title, $content, $bookingEmail);
        } else {
            $data = [
                'title' => $title,
                'content' => $content,
                'email' => $send_to,
                'name' => ''
            ];
            sendmail($data);
        }
        $status = [
            'type' => 'success',
            'title' => 'Gửi mail thành công',
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