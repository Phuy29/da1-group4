<?php
function nguoi_dung_index()
{
    $ctr = "nguoi_dung";
    $all = nguoi_dung_all();
    $data = [
        'page_title' => 'Quản lý người dùng',
        'ctr' => $ctr,
        'list' => $all,
    ];
    render('nguoi_dung.list', $data);
}

function nguoi_dung_list_quan_ly()
{
    $ctr = "nguoi_dung";
    $all = quan_ly_all();
    $data = [
        'page_title' => 'Danh sách quản lý',
        'ctr' => $ctr,
        'list' => $all,
    ];
    render('nguoi_dung.list-quan-ly', $data);
}

function nguoi_dung_set_admin()
{
    $ctr = 'nguoi_dung';
    if (!empty($_GET['id'])) {
        $id = $_GET['id'];
        $nguoi_dung = nguoi_dung_find($id);
        $email = $nguoi_dung['email'];
        nguoi_dung_cap_nhat_quyen(1, $id);
        $status = [
            'type' => 'success',
            'title' => 'Cập nhật thành công, người dùng có email: ' . $email . ' đã được đặt làm nhân viên',
        ];
        session_set('status', $status);
        redirect([
            'ctr' => $ctr,
        ]);
    }
}

function nguoi_dung_unset_admin()
{
    $ctr = 'nguoi_dung';
    if (!empty($_GET['id'])) {
        $id = $_GET['id'];
        $nguoi_dung = nguoi_dung_find($id);
        $email = $nguoi_dung['email'];
        nguoi_dung_cap_nhat_quyen(0, $id);
        $status = [
            'type' => 'success',
            'title' => 'Cập nhật thành công, đã bỏ quyền nhân viên của email: ' . $email,
        ];
        session_set('status', $status);
        redirect([
            'ctr' => $ctr,
        ]);
    }
}