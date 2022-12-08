<?php
function checkAvailableRoom()
{
    $ctr = "dat_phong";
    $room_types = loai_phong_all();
    if (isset($_POST['check_btn'])) {
        $errors = [];
        extract($_POST);
        $data = [
            'ctr' => $ctr,
            'page_title' => 'Các phòng hiện còn',
            'inputCheck' => $_POST,
            'room_types' => $room_types,
        ];
        $currentDayTs = strtotime(date('Y-m-d', time()));
        $checkinTs = strtotime($checkin);
        $checkoutTs = strtotime($checkout);
        if ($checkinTs < $currentDayTs) {
            $errors['checkin'][] = 'Không được chọn ngày bé hơn hiện tại';
        }
        if ($checkoutTs < $currentDayTs) {
            $errors['checkout'][] = 'Không được chọn ngày bé hơn hiện tại';
        }
        if ($checkoutTs < $checkinTs) {
            $errors['checkout'][] = 'Ngày rời đi không được bé hơn ngày đến';
        }
        if (!empty($errors)) {
            $previous = $_SERVER['HTTP_REFERER'];
            session_set('errors', $errors);
            session_set('inputCheck', $_POST);
            redirect($previous);
            exit();
        }
        if ($room_type_id === 'all') {
            $phong = $room_types;
            $chi_tiet_dat_phong = chi_tiet_dat_phong_all();
            $dich_vu_phong = dich_vu_loai_phong_all();
        } else {
            $phong[] = loai_phong_find_by_id($room_type_id);
            $chi_tiet_dat_phong = chi_tiet_dat_phong_find_by_room_type_id($room_type_id);
            $dich_vu_phong = dich_vu_loai_phong_find_all_by_room_type_id($room_type_id);
        }
        $phongArr = [];
        foreach ($phong as $each) {
            $room_id = $each['id'];
            if ($each['adults'] / $adults > 3): continue; endif;
            $phongArr[$room_id] = $each;
        }
        $range = [
            'min' => $checkin,
            'max' => $checkout
        ];
        foreach ($chi_tiet_dat_phong as $each) {
            $room_id = $each['room_type_id'];
            if (!empty($phongArr[$room_id])) {
                $date = [
                    'checkin' => $each['checkin'],
                    'checkout' => $each['checkout'],
                ];
                $availArr = handleCheckAvail($range, $date);
                if (empty($availArr)) {
                    unset($phongArr[$room_id]);
                } else if (is_array($availArr)) {
                    $phongArr[$room_id]['avail'] = $availArr;
                }
            }
        }
        $availArr = [
            [
                'checkin' => $checkin,
                'checkout' => $checkout,
            ],
        ];
        foreach ($phongArr as $room_id => $each) {
            if (empty($each['avail'])) {
                $phongArr[$room_id]['avail'] = $availArr;
            }
        }
        foreach ($dich_vu_phong as $each) {
            $room_id = $each['room_type_id'];
            if (!empty($phongArr[$room_id])) {
                $phongArr[$room_id]['services'][] = [
                    'room_service_id' => $each['room_service_id'],
                    'service_name' => $each['service_name'],
                ];
            }
        }
        $data['rooms'] = $phongArr;
    } else {
        $data = [
            'ctr' => $ctr,
            'page_title' => 'Các phòng hiện còn',
            'room_types' => $room_types,
        ];
    }
    render('dat_phong.check-available-room', $data);
}

function selectRoom()
{
    $ctr = 'dat_phong';
    $data = [
        'ctr' => $ctr,
        'page_title' => 'Điền thông tin',
    ];
    if (isset($_POST['select_room_btn'])) {
        extract($_POST);
        [$checkin, $checkout] = explode('|', $date);
        $room = loai_phong_find_by_id($id);
        $info = [
            'room_type_id' => $id,
            'checkin' => $checkin,
            'checkout' => $checkout,
            'adults' => $adults,
            'children' => $child,
        ];
        $data['room'] = $room;
        $data['info'] = $info;
    }
    render('dat_phong.nhap-thong-tin', $data);
}

function confirmBooking()
{
    $ctr = 'dat_phong';
    if (isset($_POST['confirm_btn'])) {
        $errors = [];
        extract($_POST);

        $room = loai_phong_find_by_id($room_type_id);
        $children = $children ?? 0;
        $dataInput = $_POST;
        $voucher_id = false;
        $code = false;
        $refresh_time = false;
        $discount = 0;
        if (!empty($voucher)) {
            $voucherDb = voucher_find_by_code($voucher);
            $voucher_id = $voucherDb['id'] ?? false;
            $code = $voucherDb['code'] ?? false;
            $refresh_time = $voucherDb['refresh_time'] ?? false;
            $isUsed = (!empty(voucher_da_dung_find($email, $code, $refresh_time)));
            if ($isUsed) {
                $errors['voucher'][] = "Mỗi email chỉ được dùng voucher này 1 lần mỗi đợt ưu đãi";
            }
            if (empty($voucherDb)) {
                $errors['voucher'][] = "Voucher không đúng";
            } elseif (!empty($voucherDb['max']) && $voucherDb['used'] == $voucherDb['max']) {
                $errors['voucher'][] = 'Voucher đã đủ lượt nhập';
            } else if ($voucherDb['status'] == 0) {
                $errors['voucher'][] = 'Voucher đã hết hạn';
            } else {
                $discount = $voucherDb['discount'];
            }
        }

        if (!empty($errors)) {
            $previous = $_SERVER['HTTP_REFERER'];
            session_set('errors', $errors);
            session_set('info', $_POST);
            session_set('room', $room);
            redirect($previous);
            exit();
        }

        $so_ngay = get_day($checkin, $checkout);
        $prices = $so_ngay * $room['price'];
        $totalPrice = $prices * (1 - $discount / 100);
        $dataBook = [
            'fullname' => $fullname,
            'email' => $email,
            'phone_number' => $phone_number,
            'adults' => $adults,
            'children' => $children,
            'checkin' => $checkin,
            'checkout' => $checkout,
            'discount' => $discount,
            'total_price' => $totalPrice,
            'room_type_id' => $room['id'],
            'price' => $room['price'],
            'so_ngay' => $so_ngay,
            'prices' => $prices,
            'room_name' => $room['name'],
            'code' => $code,
            'refresh_time' => $refresh_time,
            'voucher_id' => $voucher_id,
        ];
        session_set('dataBook', $dataBook);
    } else if (!empty(session_get('dataBook'))) {
        $dataBook = session_get('dataBook');
    }
    extract($dataBook);
    $verifyCode = cookie_get('verifyCode');
    if (empty($verifyCode)) {
        $verifyCode = rand(1000, 9999);
        $exprires = 5 * 60; // 5 phút
        cookie_set('verifyCode', $verifyCode, time() + $exprires);
        $titleMail = 'Xác nhận đặt phòng tại RioRelax';
        $contentMail = '
                Xin chào ' . $fullname . '! <br>
                Bạn đang thực hiện đặt phòng tại RioRelax, mã xác nhận của bạn là: 
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
    $dataView = $dataBook;
    $dataView['ctr'] = $ctr;
    $dataView['page_title'] = 'Xác nhận thông tin đơn đặt phòng';
    render('dat_phong.xac-nhan-thong-tin', $dataView);
}

function confirmBookingRoom()
{
    $ctr = 'dat_phong';
    if (isset($_POST['confirm_booking_btn'])) {
        $errors = [];
        $verifyCode = cookie_get('verifyCode') ?? false;
        extract($_POST);
        if ($verify_code !== $verifyCode) {
            $errors['verify_code'][] = 'Mã xác nhận không khớp hoặc đã hết hạn';
        }
        if (!empty($errors)) {
            $previous = $_SERVER['HTTP_REFERER'];
            session_set('errors', $errors);
            session_set('verify_code', $verify_code);
            redirect($previous);
            exit();
        }
        cookie_delete('verifyCode');
        $data = session_get('dataBook') ?? false;
        $bookingDetail = [];
        extract($data);
        $bookingDetail['room_type_id'] = $room_type_id;
        $bookingDetail['price'] = $price;
        $dataBooking = [
            'fullname' => $fullname,
            'phone_number' => $phone_number,
            'email' => $email,
            'adults' => $adults,
            'children' => $children,
            'checkin' => $checkin,
            'checkout' => $checkout,
            'discount' => $discount,
            'total_price' => $total_price
        ];
        if (!empty($voucher_id)) {
            voucher_cap_nhat_luot_nhap($voucher_id);
            voucher_da_dung_insert([
                'email' => $email,
                'code' => $code,
                'refresh_time' => $refresh_time
            ]);
        }
        $invoiceContent = generate_template('invoice', $data);
        $titleMail = 'Đặt phòng thành công';
        $contentMail = '
            <h4>Xin chào ' . $fullname . '!</h4>
            <p>Quý khách vừa thực hiện đặt phòng thành công, RioRelax xin gửi hóa đơn tới quý khách như sau:</p>
            ';
        $contentMail .= $invoiceContent;
        $contentMail .= '
            <p>Quý khách vui lòng kiểm tra kỹ hóa đơn, nếu có sai sót xin vui lòng liên hệ lại với chúng tôi</p>  
            <p>Cảm ơn quý khách tin dùng khách sạn của chúng tôi!</p>  
        ';
        $dataMail = [
            'email' => $email,
            'fullname' => $fullname,
            'title' => $titleMail,
            'content' => $contentMail
        ];
        sendmail($dataMail);
        session_delete('dataBook');
        $booking_id = dat_phong_insert($dataBooking);
        $bookingDetail['booking_id'] = $booking_id;
        chi_tiet_dat_phong_insert($bookingDetail);
        $status = [
            'type' => 'success',
            'title' => 'Đặt phòng thành công! Quý khách vui lòng kiểm tra hóa đơn ở email!',
        ];
        session_set('status', $status);
        redirect([
            'ctr' => 'home',
        ]);
    }
}

function handleCheckAvail($range, $date)
{
    extract($range);
    extract($date);
    $dayTs = (24 * 60 * 60);
    $minTs = strtotime($min);
    $maxTs = strtotime($max);
    $checkinTs = strtotime($checkin);
    $checkoutTs = strtotime($checkout);
    if ($checkinTs <= $minTs && $checkoutTs > $minTs && $checkoutTs < $maxTs) {
        return [
            [
                'checkin' => date('Y-m-d', $checkoutTs + $dayTs),
                'checkout' => $max,
            ],
        ];
    }
    if ($checkinTs > $minTs && $checkinTs < $maxTs && $checkoutTs >= $maxTs) {
        return [
            [
                'checkin' => $min,
                'checkout' => date('Y-m-d', $checkinTs - $dayTs),
            ],
        ];
    }
    if ($checkinTs > $minTs && $checkinTs < $maxTs && $checkoutTs > $minTs && $checkoutTs < $maxTs) {
        return [
            [
                'checkin' => $min,
                'checkout' => date('Y-m-d', $checkinTs - $dayTs),
            ],
            [
                'checkin' => date('Y-m-d', $checkoutTs + $dayTs),
                'checkout' => $max,
            ],
        ];
    }
    if ($checkinTs <= $minTs && $checkoutTs > $minTs && $checkoutTs < $maxTs) {
        return [
            [
                'checkin' => date('Y-m-d', $checkoutTs + $dayTs),
                'checkout' => $max,
            ],
        ];
    }
    if ($checkinTs === $maxTs) {
        return [
            [
                'checkin' => $min,
                'checkout' => date('Y-m-d', $maxTs - $dayTs),
            ],
        ];
    }
    if ($checkoutTs === $minTs) {
        return [
            [
                'checkin' => date('Y-m-d', $minTs + $dayTs),
                'checkout' => $max,
            ],
        ];
    }
    if ($checkinTs > $maxTs || $checkoutTs < $minTs) {
        return true;
    }
    return false;
}
