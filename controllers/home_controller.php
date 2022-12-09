<?php

// Hàm hiển thị trang chủ người dùng
function show_home()
{
    $room_types = loai_phong_all();
    $data = [
        'page_title' => 'Trang chủ',
        'room_types' => $room_types,
    ];
    render('home', $data);
}

function about()
{
    $data = [
        'page_title' => 'Giới thiệu',
    ];
    render('about', $data);
}

function services()
{
    $data = [
        'page_title' => 'Dịch vụ',
    ];
    render('services', $data);
}