<?php

// Hàm hiển thị ra trang dashboard của admin
function show_manage_rooms()
{
    $data = [
        'page_title' => 'Manage Rooms',
    ];
    render('manage_rooms', $data);
}