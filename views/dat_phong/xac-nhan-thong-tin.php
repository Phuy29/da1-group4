<?php
if (!empty(session_get('errors'))) {
    $errors = session_get('errors');
    session_delete('errors');
}
if (!empty(session_get('verify_code'))) {
    $verify_code = session_get('verify_code');
    session_delete('verify_code');
}
?>
<!-- breadcrumb-area -->
<?php require 'views/layout/partials/banner.php'; ?>
<!-- breadcrumb-area-end -->
<div class="invoice mt-5">
    <div class="card container w-50">
        <div class="card-body">
            <div class="container mb-5 mt-3">
                <div class="container">
                    <div class="col-md-12">
                        <div class="text-center">
                            <i class="far fa-building fa-4x ms-0" style="color:#8f8061 ;"></i>
                            <p class="pt-2">RioRelax</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-8">
                            <ul class="list-unstyled">
                                <li class="text-muted">To: <span style="color:#8f8061 ;"><?= $fullname ?></span></li>
                                <li class="text-muted">Email: <span style="color:#8f8061 ;"><?= $email ?></span></li>
                                <li class="text-muted"><i class="fas fa-phone"></i> <?= $phone_number ?></li>
                            </ul>
                        </div>
                    </div>
                    <div class="row my-3 mx-1 justify-content-center">
                        <table class="table">
                            <tbody>
                            <tr>
                                <td>Tên phòng</td>
                                <td><?= $room_name ?></td>
                            </tr>
                            <tr>
                                <td>Giá</td>
                                <td><?= get_price($price) ?></td>
                            </tr>
                            <tr>
                                <td>Số người lớn</td>
                                <td>
                                    <?= $adults ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Số trẻ em</td>
                                <td>
                                    <?= $children ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Thời gian</td>
                                <td>
                                    <?= $so_ngay ?> ngày,
                                    <?= get_date_range($checkin, $checkout) ?>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-xl-8">
                            <ul class="list-unstyled float-end me-0">
                                <li>
                                    <span class="me-3 float-start">
                                        Tổng tiền:
                                    </span>
                                    <?= get_price($prices) ?>
                                </li>
                                <li>
                                    <span class="me-3 float-start">
                                        Giảm giá:
                                    </span>
                                    <?= $discount ?>%
                                </li>
                            </ul>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-xl-8" style="margin-left:60px">
                                <p class="float-end"
                                   style="font-size: 30px; color: red; font-weight: 400;font-family: Arial, Helvetica, sans-serif;">
                                    Thành tiền:
                                    <?= get_price($total_price) ?></span></p>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="row mt-2 mb-5">
                    <form method="post" id="form" action="?ctr=<?= $ctr ?>&act=confirm_booking">
                        <div class="form-group">
                            <label for="">
                                Mã xác nhận
                            </label>
                            <p>
                                (Một mã xác nhận đã được gửi đến email <?= $email ?>, hãy kiểm tra và nhập mã xác nhận
                                xuống dưới)
                            </p>
                            <input type="text" class="form-control" name="verify_code" placeholder="XXXX"
                                   value="<?= $verify_code ?? '' ?>">
                            <?php if (!empty($errors['verify_code'])): ?>
                                <div class="error text-danger">
                                    <span><?= $errors['verify_code'][0] ?></span>
                                </div>
                            <?php endif; ?>
                        </div>
                        <button class="btn rounded p-2" name="confirm_booking_btn">Xác nhận đặt phòng</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $("#form").validate({
            rules: {
                "verify_code": {
                    required: true,
                    rangelength: [4, 4]
                },
            },
            messages: {
                "verify_code": {
                    required: 'Vui lòng nhập trường này',
                    rangelength: 'Mã xác nhận bao gồm 4 ký tự',
                },
            }
        });
    })
</script>