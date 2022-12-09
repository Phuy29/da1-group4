<?php
function loai_phong_index()
{
    $ctr = "loai_phong";
    $room_types = loai_phong_all();
    render('loai_phong.list', [
        'page_title' => 'Tất cả phòng',
        'ctr' => $ctr,
        'room_types' => $room_types,
    ]);
}

function loai_phong_detail()
{
    $ctr = "loai_phong";
    $id = $_GET['id'] ?? false;
    if (!empty($id)) {
        $room_type = loai_phong_find_by_id($id);
        $images = anh_loai_phong_find_all_by_room_type_id($room_type['id']);
        $services = dich_vu_loai_phong_find_all_by_room_type_id($room_type['id']);
        $room_type['images'] = $images;
        $room_type['services'] = $services;
        render('loai_phong.detail', [
            'ctr' => $ctr,
            'page_title' => $room_type['name'],
            'room' => $room_type,
        ]);
    }
}