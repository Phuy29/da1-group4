<?php
function dich_vu_phong_index()
{
    $ctr = "dich_vu_phong";
    $all = dich_vu_phong_all();
    $data = [
        'page_title' => 'Quản lý dịch vụ phòng',
        'ctr' => $ctr,
        'list' => $all,
    ];
    render('dich_vu_phong.list', $data);
}

function dich_vu_phong_create()
{
    $ctr = "dich_vu_phong";
    $data = [
        'page_title' => 'Thêm dịch vụ phòng',
        'ctr' => $ctr,
    ];
    render('dich_vu_phong.create', $data);
}

function dich_vu_phong_store()
{
    $ctr = "dich_vu_phong";
    if (isset($_POST['dich_vu_phong_create'])) {
        $errors = [];
        foreach ($_POST as $key => $field) {
            if ($key !== 'dich_vu_phong_create' && $field === '') {
                $errors[$key][] = 'Vui lòng nhập trường này';
            }
        }
        if (!empty($errors)) {
            session_set('errors', $errors);
            redirect([
                'ctr' => $ctr,
                'act' => 'create'
            ]);
            exit();
        }
        $name = $_POST['name'];
        $data = [
            'name' => $name,
        ];
        $id = dich_vu_phong_insert($data);

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

function dich_vu_phong_edit()
{
    $ctr = "dich_vu_phong";
    if (!empty($_GET['id'])) {
        $id = $_GET['id'];
        $item = dich_vu_phong_find($id);
        $data = [
            'page_title' => 'Sửa dịch vụ phòng',
            'ctr' => $ctr,
            'item' => $item,
        ];
        render('dich_vu_phong.edit', $data);
    }
}

function dich_vu_phong_update()
{
    $ctr = 'dich_vu_phong';
    if (isset($_POST['dich_vu_phong_edit'])) {
        $errors = [];
        $id = $_POST['id'];
        $name = $_POST['name'];
        foreach ($_POST as $key => $field) {
            if ($key !== 'dich_vu_phong_edit' && $field === '') {
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
            'name' => $name,
            'id' => $id,
        ];
        dich_vu_phong_cap_nhat($data);
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

function dich_vu_phong_delete()
{
    $ctr = 'dich_vu_phong';
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $data = [
            'id' => $id,
        ];
        dich_vu_loai_phong_destroy_by_room_service_id(['room_service_id' => $id]);
        dich_vu_phong_destroy($data);

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