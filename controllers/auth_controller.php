<?php
function signUp()
{
    $ctr = 'auth';
    $data = [
        'page_title' => 'Đăng ký',
        'ctr' => $ctr,
    ];
    render('auth.sign-up', $data);
}

function signin()
{
    $ctr = 'auth';
    $data = [
        'page_title' => 'Đăng nhập',
        'ctr' => $ctr,
    ];
    render('auth.sign-in', $data);
}

function login($user)
{
    $ctr = 'auth';
    session_set('user_session', $user);
    redirect([
        'ctr' => $ctr,
        'act' => 'info'
    ]);
}

function userLogOut()
{
    session_delete('user_session');
    redirect([
        'ctr' => 'home'
    ]);
}

function userInfo()
{
    $ctr = 'auth';
    $user_session = session_get('user_session');
    if (empty($user_session)) {
        redirect([
            'ctr' => $ctr,
            'act' => 'signup',
        ]);
    }
    $user_id = $user_session['id'];
    $user = nguoi_dung_find_by_id($user_id);
    $data = [
        'page_title' => 'Thông tin tài khoản',
        'ctr' => 'auth',
        'user' => $user,
    ];
    render('auth.info', $data);
}

function userUpdate()
{
    $ctr = 'auth';
    if (isset($_POST['update_user_btn'])) {
        extract($_POST);
        $errors = [];
        foreach ($_POST as $key => $field) {
            if ($key !== 'update_user_btn' && $field === '') {
                $errors[$key][] = 'Vui lòng nhập trường này';
            }
        }
        if (!empty($errors)) {
            session_set('errors', $errors);
            redirect([
                'ctr' => $ctr,
                'act' => 'info'
            ]);
            exit();
        }
        $data = [
            'fullname' => $fullname,
            'phone_number' => $phone_number,
            'id' => $id,
        ];
        nguoi_dung_cap_nhat($data);
        $user = nguoi_dung_find_by_id($id);
        $status = [
            'type' => 'success',
            'title' => 'Thay đổi thông tin thành công'
        ];
        session_set('status', $status);
        login($user);
    }
}

function handleRegist()
{
    $ctr = 'auth';
    if (isset($_POST['signup_btn'])) {
        extract($_POST);
        $errors = [];
        foreach ($_POST as $key => $field) {
            if ($key !== 'signup_btn' && $field === '') {
                $errors[$key][] = 'Vui lòng nhập trường này';
            }
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'][] = 'Vui lòng nhập đúng định dạng email';
        }
        if (mb_strlen($fullname, 'UTF-8') < 2) {
            $errors['fullname'][] = 'Không nhập ít hơn 3 ký tự';
        }

        $user = nguoi_dung_find_by_email($email);
        if (!empty($user)) {
            $errors['email'][] = 'Email đã tồn tại, vui lòng nhập email khác';
        }

        session_set('data', $_POST);
        if (!empty($errors)) {
            session_set('errors', $errors);
            redirect([
                'ctr' => $ctr,
                'act' => 'signup'
            ]);
            exit();
        }
        $verifyCode = cookie_get('verifyCode');
        if (empty($verifyCode)) {
            $verifyCode = rand(1000, 9999);
            $exprires = 5 * 60; // 5 phút
            cookie_set('verifyCode', $verifyCode, time() + $exprires);
            $titleMail = 'Xác nhận đăng ký tài khoản ZCube';
            $contentMail = '
                Xin chào ' . $fullname . '! <br>
                Bạn đang thực hiện đăng ký tài khoản hệ thống ZCube, mã xác nhận đăng ký tài khoản của bạn là: 
                <b style="font-size: 20px"> ' . $verifyCode . '</b>
            ';
            $dataMail = [
                'email' => $email,
                'fullname' => $fullname,
                'title' => $titleMail,
                'content' => $contentMail,
            ];
            sendmail($dataMail);
        }
        render('auth.confirm-regist', [
            'page_title' => 'Xác nhận email',
            'ctr' => $ctr,
        ]);
    }
}


function confirmRegistCode()
{
    $ctr = 'auth';
    if (isset($_POST['confirm_btn'])) {
        $errors = [];
        $verifyCode = cookie_get('verifyCode') ?? false;
        extract($_POST);
        foreach ($_POST as $key => $field) {
            if ($key !== 'confirm_btn' && $field === '') {
                $errors[$key][] = 'Vui lòng nhập trường này';
            }
        }

        if (mb_strlen($verify_code, 'UTF-8') !== 4) {
            $errors['verify_code'][] = 'Mã xác nhận phải gồm 4 ký tự';
        }

        if ($verify_code !== $verifyCode) {
            $errors['verify_code'][] = 'Mã xác nhận không khớp hoặc đã hết hạn';
        }
        if (!empty($errors)) {
            session_set('errors', $errors);
            render('auth.confirm-regist', [
                'page_title' => 'Xác nhận email',
                'ctr' => $ctr,
            ]);
            exit();
        }
        cookie_delete('verifyCode');
        $data = session_get('data') ?? false;
        session_delete('data');
        if (empty($data)) {
            redirect([
                'ctr' => $ctr,
                'act' => 'signup'
            ]);
        }
        unset($data['signup_btn'], $data['address'], $data['repassword']);
        nguoi_dung_insert($data);
        $user = nguoi_dung_find_to_login($data['email'], $data['password']);
        $status = [
            'type' => 'success',
            'title' => 'Đăng ký thành công',
        ];
        session_set('status', $status);
        login($user);
    }
}

function processSignIn()
{
    $ctr = 'auth';
    if (isset($_POST['signin_btn'])) {
        extract($_POST);
        $errors = [];
        foreach ($_POST as $key => $field) {
            if ($key !== 'signin_btn' && $field === '') {
                $errors[$key][] = 'Vui lòng nhập trường này';
            }
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'][] = 'Vui lòng nhập đúng định dạng email';
        }

        $user = nguoi_dung_find_to_login($email, $password);

        if (empty($user)) {
            $errors['email'][] = 'Email hoặc mật khẩu không hợp lệ';
            $errors['password'][] = 'Email hoặc mật khẩu không hợp lệ';
        }

        if (!empty($errors)) {
            session_set('errors', $errors);
            session_set('data', $_POST);
            redirect([
                'ctr' => $ctr,
                'act' => 'signin'
            ]);
            exit();
        }
        $status = [
            'type' => 'success',
            'title' => 'Đăng nhập thành công',
        ];
        session_set('status', $status);
        login($user);
    }
}

