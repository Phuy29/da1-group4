<?php

// Hàm hiển thị ra trang dashboard của admin
function loai_phong_index()
{
    $data = [
        'page_title' => 'Quản lý loại phòng',
    ];
    render('loai_phong.list', $data);
}