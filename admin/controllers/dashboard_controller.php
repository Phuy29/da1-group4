<?php

// Hàm hiển thị ra trang dashboard của admin
function show_dashboard()
{
    $data = [
        'page_title' => 'Dashboard',
    ];
    render('dashboard', $data);
}