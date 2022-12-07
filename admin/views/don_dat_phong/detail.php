<?php
if (!empty(session_get('statusSession'))) {
    $statusSession = session_get('statusSession');
    session_delete('statusSession');
}
?>
    <div class="container">
        <a href="?ctr=<?= $ctr ?>" class="btn btn-primary">Quay lại trang danh sách đơn đặt phòng</a>
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
                            <tr>
                                <td>Trạng thái</td>
                                <td>
                                    <form class="d-flex" action="?ctr=<?= $ctr ?>&act=set_status" method="post">
                                        <input type="hidden" name="id" value="<?= $id ?>">
                                        <select name="status" id="" class="form-select w-50 me-2">
                                            <?php foreach (_BOOKING_STATUS as $statusIndex => $nameStatus): ?>
                                                <option value="<?= $statusIndex ?>"
                                                    <?php if ($statusIndex == $bookingStatus): ?>
                                                        selected
                                                    <?php endif; ?>
                                                >
                                                    <?= $nameStatus ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                        <button class="btn btn-primary" name="set_status_btn">Xác nhận</button>
                                    </form>
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
            </div>
        </div>
    </div>
    <script src="../public/admin/dist/assets/extensions/sweetalert2/sweetalert2.min.js"></script>
<?php if (!empty($statusSession)) : ?>
    <script>
        window.onload = () => {
            Swal.fire({
                icon: `<?= $statusSession['type'] ?>`,
                title: `<?= $statusSession['title'] ?>`,
            })
        }
    </script>
<?php endif; ?>