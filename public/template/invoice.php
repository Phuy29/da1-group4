<div class="border rounded p-3 my-3"
     style="width: 700px; padding: 20px 20px 0 20px; border: 1px solid #ccc; border-radius: 15px;">
    <div class="col-md-12">
        <div class="text-center">
            <i class="far fa-building fa-4x ms-0" style="color:#8f8061 ;"></i>
            <p class="pt-2">RioRelax</p>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-8">
            <ul class="list-unstyled" style="list-style: none; padding-left: 0;">
                <li class="text-muted">To: <span style="color:#8f8061 ;"><?= $fullname ?></span></li>
                <li class="text-muted">Email: <span style="color:#8f8061 ;"><?= $email ?></span></li>
                <li class="text-muted">Số điện thoại:<i class="fas fa-phone"></i> <?= $phone_number ?></li>
            </ul>
        </div>
    </div>
    <hr>
    <div class="row my-3 mx-1 justify-content-center">
        <table class="table">
            <tbody>
            <tr>
                <td>Tên phòng:</td>
                <td><?= $room_name ?></td>
            </tr>
            <tr>
                <td>Giá:</td>
                <td><?= get_price($price) ?></td>
            </tr>
            <tr>
                <td>Số người lớn:</td>
                <td>
                    <?= $adults ?>
                </td>
            </tr>
            <tr>
                <td>Số trẻ em:</td>
                <td>
                    <?= $children ?>
                </td>
            </tr>
            <tr>
                <td>Thời gian:</td>
                <td>
                    <?= $so_ngay ?> ngày,
                    <?= get_date_range($checkin, $checkout) ?>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
    <hr>
    <div class="row">
        <div class="col-xl-8">
            <ul class="list-unstyled float-end me-0" style="list-style: none; padding-left: 0;">
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
            <div class="col-xl-8" style="">
                <p class="float-end text-center"
                   style="font-size: 30px; margin: 10px 0; color: red; font-weight: 400;font-family: Arial, Helvetica, sans-serif;">
                    Thành tiền:
                    <?= get_price($total_price) ?></span></p>
            </div>

        </div>
    </div>
</div>