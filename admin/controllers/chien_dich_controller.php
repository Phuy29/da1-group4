<?php
function chien_dich_index()
{
    $ctr = "chien_dich";
    $all = chien_dich_all();
    $data = [
        'page_title' => 'Quản lý chiến dịch',
        'ctr' => $ctr,
        'list' => $all,
    ];
    render('chien_dich.list', $data);
}

function chien_dich_create()
{
    $ctr = "chien_dich";
    $data = [
        'page_title' => 'Thêm chiến dịch',
        'ctr' => $ctr,
    ];
    render('chien_dich.create', $data);
}

function chien_dich_store()
{
    $ctr = "chien_dich";
    if (isset($_POST['chien_dich_create'])) {
//        echo '<pre>';
//        print_r($_POST);
        // die();
        $errors = [];
        foreach ($_POST as $key => $field) {
            if ($key !== 'chien_dich_create' && $field === '') {
                $errors[$key][] = 'Vui lòng nhập trường này';
            }
        }
        $startTs = strtotime($_POST['started_at']);
        $finishTs = strtotime($_POST['finished_at']);
        if ($finishTs < $startTs) {
            $errors['finished_at'][] = 'Ngày kết thúc không được nhỏ hơn ngày bắt đầu';
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
        // var_dump($_POST['started_at']);
        // die();
        // die(strtotime($_POST['finished_at']));
        $started_at = $_POST['started_at'];
        $finished_at = $_POST['finished_at'];
        $data = [
            'name' => $name,
            'started_at' => $started_at,
            'finished_at' => $finished_at,
        ];
        $id = chien_dich_insert($data);

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

function chien_dich_edit()
{
    $ctr = "chien_dich";
    if (!empty($_GET['id'])) {
        $id = $_GET['id'];
        $item = chien_dich_find($id);
        $data = [
            'page_title' => 'Sửa chiến dịch',
            'ctr' => $ctr,
            'item' => $item,
        ];
        render('chien_dich.edit', $data);
    }
}

function chien_dich_update()
{
    $ctr = 'chien_dich';
    if (isset($_POST['chien_dich_edit'])) {
        $errors = [];
        $id = $_POST['id'];
        $name = $_POST['name'];
        foreach ($_POST as $key => $field) {
            if ($key !== 'chien_dich_edit' && $field === '') {
                $errors[$key][] = 'Vui lòng nhập trường này';
            }
        }
        $startTs = strtotime($_POST['started_at']);
        $finishTs = strtotime($_POST['finished_at']);
        if ($finishTs < $startTs) {
            $errors['finished_at'][] = 'Ngày kết thúc không được nhỏ hơn ngày bắt đầu';
        }
        if (!empty($errors)) {
            session_set('errors', $errors);
            redirect([
                'ctr' => $ctr,
                'act' => 'edit',
                'id' => $id
            ]);
            exit();
        }

        $started_at = strtotime($_POST['started_at']);
        $started_at = date('Y-m-d H:i:s', $started_at);
        $finished_at = strtotime($_POST['finished_at']);
        $finished_at = date('Y-m-d H:i:s', $finished_at);
        $data = [
            'name' => $name,
            'id' => $id,
            'started_at' => $started_at,
            'finished_at' => $finished_at,
        ];
        chien_dich_cap_nhat($data);
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

function chien_dich_delete()
{
    $ctr = 'chien_dich';
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $data = [
            'id' => $id,
        ];
        chien_dich_destroy($data);

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
