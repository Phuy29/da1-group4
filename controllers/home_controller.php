<?php

// Hàm hiển thị trang chủ người dùng
function show_home()
{
    $data = [
        'page_title' => 'Trang chủ',
    ];
    render('home', $data);
}

function about() {
    $data = [
        'page_title' => 'About',
    ];
    render('about', $data);
}