<?php
function signUp() {
//    die('sign up');
    $data = [
        'page_title' => 'Đăng ký',
    ];
    render('auth.sign-up', $data);
}