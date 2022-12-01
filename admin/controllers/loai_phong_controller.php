<?php
function loai_phong_index()
{
    $ctr = "loai_phong";
    $all = loai_phong_all();
    //    echo '<pre>';
    //    print_r($all);
    //    echo '</pre>';
    //    die();
    $data = [
        'page_title' => 'Quản lý dịch vụ phòng',
        'ctr' => $ctr,
        'list' => $all,
    ];
    render('loai_phong.list', $data);
}

function loai_phong_create()
{
    $ctr = "loai_phong";
    $loai_giuong = loai_giuong_all();
    $dich_vu_phong = dich_vu_phong_all();
    $data = [
        'page_title' => 'Thêm dịch vụ phòng',
        'ctr' => $ctr,
        'bed_types' => $loai_giuong,
        'room_services' => $dich_vu_phong,
    ];
    render('loai_phong.create', $data);
}

function loai_phong_store()
{
    $ctr = "loai_phong";
    if (isset($_POST['loai_phong_create'])) {
        extract($_POST);
        $file_name_upload = [];
        $errors = [];
        if (!empty(loai_phong_find_by_name($name))) {
            $errors['name'][] = 'Phòng đã tồn tại, vui lòng thêm phòng khác';
        }
        foreach ($_POST as $key => $field) {
            if ($key !== 'loai_phong_create' && $field === '') {
                $errors[$key][] = 'Vui lòng nhập trường này';
            }
        }
        if (mb_strlen($name, 'UTF-8') <= 3) {
            $errors['name'][] = 'Không nhập ít hơn 3 ký tự';
        }
        if (mb_strlen($description, 'UTF-8') <= 8) {
            $errors['description'][] = 'Không nhập ít hơn 8 ký tự';
        }
        if ($adults <= 0) {
            $errors['adults'][] = "Số người lớn tối thiểu là 1";
        }
        if ($size <= 0) {
            $errors['size'][] = "Diện tích phòng phải lớn hơn 0";
        }
        if ($price <= 0) {
            $errors['price'][] = "Giá phòng phải lớn hơn 0";
        }
        if (empty($_POST['room_type_services'])) {
            $errors['room_type_services'][] = "Vui lòng chọn dịch vụ phòng";
        }
        if (empty($_FILES['photos']['name'][0])) {
            $errors['photos'][] = "Vui lòng chọn ảnh";
        } else {
            $allow_type = ['jpg', 'png', 'jpeg'];
            $file = $_FILES['photos'];
            $folder = to_slug($name);
            $dir = _UPLOAD_DIR . 'loai-phong/' . $folder . '/';
            if (!is_dir($dir)) {
                mkdir($dir, 0777);
            }
            foreach ($file['name'] as $index => $photo_name) {
                $ext = pathinfo($photo_name, PATHINFO_EXTENSION);
                $ext = strtolower($ext);
                if (!in_array($ext, $allow_type)) {
                    $errors['photos'][] = 'Không đúng định dạng ảnh, hãy thử lại';
                    break;
                }
                $file_name = $index . '.' . $ext;
                //                die($dir);
                $file_path = ltrim($dir, '\.\./') . $file_name;
                $target_file = $dir . $file_name;
                $file_name_upload[] = $file_path;
                move_uploaded_file($file['tmp_name'][$index], $target_file);
            }
        }

        if (!empty($errors)) {
            session_set('errors', $errors);
            session_set('data', $_POST);
            redirect([
                'ctr' => $ctr,
                'act' => 'create'
            ]);
            exit();
        }
        $data = [
            'name' => $name,
            'adults' => $adults,
            'size' => $size,
            'bed_type_id' => $bed_type_id,
            'price' => $price,
            'description' => $description,
        ];
        $id = loai_phong_insert($data);
        foreach ($file_name_upload as $file_path) {
            $data = [
                'image' => $file_path,
                'room_type_id' => $id,
            ];
            anh_loai_phong_insert($data);
        }
        foreach ($room_type_services as $room_type_service) {
            $data = [
                'room_service_id' => $room_type_service,
                'room_type_id' => $id,
            ];
            dich_vu_loai_phong_insert($data);
        }
        //        die('done');

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

function loai_phong_edit()
{
    $ctr = "loai_phong";
    $loai_giuong = loai_giuong_all();
    $dich_vu_phong = dich_vu_phong_all();
    if (!empty($_GET['id'])) {
        $id = $_GET['id'];
        $item = loai_phong_find($id);
        $service_room_types = service_room_type_find_by_room_type_id($id);
        $room_service_ids = [];
        foreach ($service_room_types as $service_room_type) {
            array_push($room_service_ids, $service_room_type['room_service_id']);
        };
        $data = [
            'page_title' => 'Sửa loại phòng',
            'ctr' => $ctr,
            'item' => $item,
            'bed_types' => $loai_giuong,
            'room_services' => $dich_vu_phong,
            'room_service_ids' => $room_service_ids,
        ];
        // var_dump($data['item']);
        // die();
        render('loai_phong.edit', $data);
    }
}

function loai_phong_update()
{
    $ctr = 'loai_phong';
    // var_dump($_POST);
    // die();  
    if (isset($_POST['loai_phong_edit'])) {
        extract($_POST);
        $file_name_upload = [];
        $errors = [];
        // if (!empty(loai_phong_find_by_name($name))) {
        //     $errors['name'][] = 'Phòng đã tồn tại, vui lòng thêm phòng khác';
        // }
        foreach ($_POST as $key => $field) {
            if ($key !== 'loai_phong_edit' && $field === '') {
                $errors[$key][] = 'Vui lòng nhập trường này';
            }
        }
        if (mb_strlen($name, 'UTF-8') <= 3) {
            $errors['name'][] = 'Không nhập ít hơn 3 ký tự';
        }
        if (mb_strlen($description, 'UTF-8') <= 8) {
            $errors['description'][] = 'Không nhập ít hơn 8 ký tự';
        }
        if ($adults <= 0) {
            $errors['adults'][] = "Số người lớn tối thiểu là 1";
        }
        if ($size <= 0) {
            $errors['size'][] = "Diện tích phòng phải lớn hơn 0";
        }
        if ($price <= 0) {
            $errors['price'][] = "Giá phòng phải lớn hơn 0";
        }
        if (empty($_POST['room_type_services'])) {
            $errors['room_type_services'][] = "Vui lòng chọn dịch vụ phòng";
        }
        if (empty($_FILES['photos']['name'][0])) {
            $errors['photos'][] = "Vui lòng chọn ảnh";
        } else {
            $allow_type = ['jpg', 'png', 'jpeg'];
            $file = $_FILES['photos'];
            $folder = to_slug($name);
            $dir = _UPLOAD_DIR . 'loai-phong/' . $folder . '/';
            if (!is_dir($dir)) {
                mkdir($dir, 0777);
            }
            foreach ($file['name'] as $index => $photo_name) {
                $ext = pathinfo($photo_name, PATHINFO_EXTENSION);
                $ext = strtolower($ext);
                if (!in_array($ext, $allow_type)) {
                    $errors['photos'][] = 'Không đúng định dạng ảnh, hãy thử lại';
                    break;
                }
                $file_name = $index . '.' . $ext;
                //                die($dir);
                $file_path = ltrim($dir, '\.\./') . $file_name;
                $target_file = $dir . $file_name;
                $file_name_upload[] = $file_path;
                move_uploaded_file($file['tmp_name'][$index], $target_file);
            }
        }

        // var_dump($errors);
        // die(); 

        if (!empty($errors)) {
            session_set('errors', $errors);
            session_set('data', $_POST);
            redirect([
                'ctr' => $ctr,
                'act' => 'edit',
                'id' => $id,
            ]);
            exit();
        }
        $data = [
            'id' => $id,
            'name' => $name,
            'adults' => $adults,
            'size' => $size,
            'bed_type_id' => $bed_type_id,
            'price' => $price,
            'description' => $description,
        ];
        loai_phong_cap_nhat($data);
       
        foreach ($file_name_upload as $file_path) {
            $data = [
                'image' => $file_path,
                'room_type_id' => (int)$id,
            ];
            anh_loai_phong_cap_nhat($data);
        }
        foreach ($room_type_services as $room_type_service) {
            $data = [
                'room_service_id' => $room_type_service,
                'room_type_id' => $id,
            ];
            dich_vu_loai_phong_insert($data);
        }
            //    die('done');

        $status = [
            'type' => 'success',
            'title' => 'Cập nhật thành công',
        ];
        session_set('status', $status);
        redirect([
            'ctr' => $ctr,
        ]);
    }
    // if (isset($_POST['loai_phong_edit'])) {
    //     $errors = [];
    //     $id = $_POST['id'];
    //     $name = $_POST['name'];
    //     foreach ($_POST as $key => $field) {
    //         if ($key !== 'loai_phong_edit' && $field === '') {
    //             $errors[$key]['required'] = 'Vui lòng nhập trường này';
    //         }
    //     }
    //     if (!empty($errors)) {
    //         session_set('errors', $errors);
    //         redirect([
    //             'ctr' => $ctr,
    //             'act' => 'edit',
    //             'id' => $id,
    //         ]);
    //         exit();
    //     }
    //     $data = [
    //         'name' => $name,
    //         'id' => $id,
    //     ];
    //     loai_phong_cap_nhat($data);
    //     $status = [
    //         'type' => 'success',
    //         'title' => 'Cập nhật thành công',
    //     ];
    //     session_set('status', $status);
    //     redirect([
    //         'ctr' => $ctr,
    //     ]);
    // }
}

function loai_phong_delete()
{
    $ctr = 'loai_phong';
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $data = [
            'id' => $id,
        ];
        $anh = anh_loai_phong_find_first_by_room_type_id($id);
        if (!empty($anh)) {
            $file_path = $anh['image'];
            $file_path_arr = explode('/', $file_path);
            $length = count($file_path_arr);
            unset($file_path_arr[$length - 1]);
            $dir = '../' . implode('/', $file_path_arr) . '/';
            if (is_dir($dir)) {
                deleteDirectory($dir);
            }
        }
        anh_loai_phong_destroy(['room_type_id' => $id]);
        dich_vu_loai_phong_destroy_by_room_type_id(['room_type_id' => $id]);
        loai_phong_destroy($data);

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
