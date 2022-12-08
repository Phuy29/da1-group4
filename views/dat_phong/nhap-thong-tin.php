<?php
if (!empty(session_get('user_session'))) {
    $user_session = session_get('user_session');
    $fullname = $user_session['fullname'];
    $email = $user_session['email'];
    $phone_number = $user_session['phone_number'];
}
if (!empty(session_get('errors'))) {
    $errors = session_get('errors');
    session_delete('errors');
}
if (!empty(session_get('info'))) {
    $info = session_get('info');
    $fullname = $info['fullname'];
    $email = $info['email'];
    $phone_number = $info['phone_number'];
    session_delete('info');
}
if (!empty(session_get('room'))) {
    $room = session_get('room');
    session_delete('room');
}
if (empty($info)) {
    redirect([
        'ctr' => 'home',
    ]);
}
?>
<!-- breadcrumb-area -->
<?php require 'views/layout/partials/banner.php'; ?>
<!-- breadcrumb-area-end -->
<div class="container w-50">
    <h2 class="text-center pt-5">Nhập thông tin</h2>
    <form action="?ctr=<?= $ctr ?>&act=confirm" id="form" method="post" class="row py-3">
        <input type="hidden" name="room_type_id" value="<?= $room['id'] ?>">
        <input type="hidden" name="adults" value="<?= $info['adults'] ?>">
        <input type="hidden" name="children" value="<?= $info['children'] ?>">
        <input type="hidden" name="checkin" value="<?= $info['checkin'] ?>">
        <input type="hidden" name="checkout" value="<?= $info['checkout'] ?>">
        <div class="form-group col-md-6">
            <label for="">Tên phòng</label>
            <input class="form-control" type="text" disabled readonly value="<?= $room['name'] ?>">
        </div>
        <div class="form-group col-md-6">
            <label for="">Giá</label>
            <input class="form-control" type="text" disabled readonly value="<?= get_price($room['price']) ?>/Ngày">
        </div>
        <div class="form-group col-md-12">
            <label for="">Email</label>
            <input class="form-control" type="text" name="email" placeholder="Email"
                   value="<?= $email ?? '' ?>">
        </div>
        <div class="form-group col-md-6">
            <label for="">Họ tên</label>
            <input class="form-control" type="text" name="fullname" placeholder="Họ và tên"
                   value="<?= $fullname ?? '' ?>">
        </div>
        <div class=" form-group col-md-6">
            <label for="">Số điện thoại</label>
            <input class="form-control" type="text" name="phone_number" placeholder="Số điện thoại"
                   value="<?= $phone_number ?? '' ?>">
        </div>
        <div class=" form-group col-md-4">
            <label for="">Thời gian</label>
            <input class="form-control" type="text" disabled readonly
                   value="<?= get_date_range($info['checkin'], $info['checkout']) ?>">
        </div>
        <div class="form-group col-md-4">
            <label for="">Số người lớn</label>
            <input class="form-control" type="text" disabled readonly value="<?= $info['adults'] ?>">
        </div>
        <div class="form-group col-md-4">
            <label for="">Số trẻ em</label>
            <input class="form-control" type="text" disabled readonly value="<?= $info['children'] ?>">
        </div>
        <div class="form-group col-md-12">
            <label for="">Mã giảm giá (nếu có)</label>
            <input class="form-control" type="text" name="voucher" placeholder="XXXXXXXXXX"
                   value="<?= $info['voucher'] ?? '' ?>">
            <?php if (!empty($errors['voucher'])): ?>
                <div class="error text-danger">
                    <span><?= $errors['voucher'][0] ?></span>
                </div>
            <?php endif; ?>
        </div>
        <button class=" btn mb-5" name="confirm_btn">Đặt phòng</button>
    </form>
</div>

<script>
    $(document).ready(function () {
        $("#form").validate({
            rules: {
                "email": {
                    required: true,
                    email: true,
                },
                "fullname": {
                    required: true,
                    minlength: 3,
                },
                "phone_number": {
                    required: true,
                    minlength: 10,
                },
                "voucher": {
                    rangelength: [10, 10]
                },
            },
            messages: {
                "email": {
                    required: 'Vui lòng nhập trường này',
                    email: 'Vui lòng nhập đúng định dạng email',
                },
                "fullname": {
                    required: 'Vui lòng nhập trường này',
                    minlength: 'Không nhập ít hơn 3 ký tự',
                },
                "phone_number": {
                    required: 'Vui lòng nhập trường này',
                    minlength: 'Nhập đúng số điện thoại',
                },
                "voucher": {
                    rangelength: 'Voucher phải gồm 10 ký tự',
                },
            }
        });
    })
</script>