<?php
if (!empty(session_get('errors'))) {
    $errors = session_get('errors');
    session_delete('errors');
}
if (!empty(session_get('inputCheck'))) {
    $inputCheck = session_get('inputCheck');
    session_delete('inputCheck');
}
?>
<!-- breadcrumb-area -->
<?php require 'views/layout/partials/banner.php'; ?>
<!-- breadcrumb-area-end -->
<!-- booking-area -->
<div id="booking" class="booking-area p-relative">
    <div class="container">
        <form action="?ctr=dat_phong&act=check_available_home" id="form" method="post" class="contact-form">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <ul class="d-flex justify-content-center">
                        <li>
                            <div class="contact-field p-relative c-name">
                                <label><i class="fal fa-badge-check"></i> Ngày bắt đầu</label>
                                <input type="date" id="checkin" name="checkin"
                                       value="<?= $inputCheck['checkin'] ?? '' ?>">
                                <?php if (!empty($errors['checkin'])): ?>
                                    <div class="error text-danger">
                                        <span><?= $errors['checkin'][0] ?></span>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </li>
                        <li>
                            <div class="contact-field p-relative c-name">
                                <label><i class="fal fa-times-octagon"></i> Ngày rời đi</label>
                                <input type="date" id="checkout" name="checkout"
                                       value="<?= $inputCheck['checkout'] ?? '' ?>">
                                <?php if (!empty($errors['checkout'])): ?>
                                    <div class="error text-danger">
                                        <span><?= $errors['checkout'][0] ?></span>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </li>
                        <li>
                            <div class="contact-field p-relative c-name">
                                <label><i class="fal fa-users"></i> Số người lớn</label>
                                <select class="form-select" name="adults" id="adu">
                                    <option value="">Số người lớn</option>
                                    <?php for ($i = 1; $i <= 10; $i++): ?>
                                        <option
                                                value="<?= $i ?>"
                                            <?php if (!empty($inputCheck['adults']) && $i == $inputCheck['adults']): ?>
                                                selected
                                            <?php endif; ?>
                                        >
                                            <?= $i ?>
                                        </option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                        </li>
                        <li>
                            <div class="contact-field p-relative c-name">
                                <label><i class="fal fa-baby"></i> Số trẻ em</label>
                                <select class="form-select" name="child" id="cld">
                                    <?php for ($i = 0; $i <= 5; $i++): ?>
                                        <option
                                                value="<?= $i ?>"
                                            <?php if (!empty($inputCheck['child']) && $i == $inputCheck['child']): ?>
                                                selected
                                            <?php endif; ?>
                                        >
                                            <?= $i ?>
                                        </option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                        </li>
                        <li>
                            <div class="contact-field p-relative c-name">
                                <label><i class="fal fa-concierge-bell"></i> Loại phòng</label>
                                <select class="form-control" name="room_type_id" id="rti">
                                    <option value="all">Tất cả phòng</option>
                                    <?php foreach ($room_types as $room_type): ?>
                                        <option value="<?= $room_type['id'] ?>"
                                            <?php if (!empty($inputCheck['room_type_id']) && $room_type['id'] == $inputCheck['room_type_id']): ?>
                                                selected
                                            <?php endif; ?>
                                        ><?= $room_type['name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </li>
                        <li>
                            <div class="slider-btn">
                                <label><i class="fal fa-calendar-alt"></i></label>
                                <button class="btn ss-btn" data-animation="fadeInRight" data-delay=".8s"
                                        name="check_btn">
                                    Tìm phòng
                                </button>
                            </div>
                        </li>
                    </ul>
                </div>

            </div>

        </form>
    </div>
</div>
<!-- booking-area-end -->

<h1 class="container mt-5 mb-0">Các phòng hiện còn</h1>

<!-- Project Detail -->
<section class="team-area-content pt-5">
    <div class="container">
        <!-- Lower Content -->
        <?php if (empty($rooms)): ?>
            <h3>Không tìm thấy phòng theo yêu cầu, hãy thử tìm kiếm theo ngày khác</h3>
        <?php else: ?>
            <div class="lower-content">
                <?php foreach ($rooms as $room): ?>
                    <div class="row mb-5">
                        <div class="col-lg-4 col-md-12 col-sm-12">
                            <div class="team-img-box">
                                <img src="public/img/gallery/room-img01.png" alt="img">
                            </div>

                        </div>

                        <div class="text-column col-lg-8 col-md-12 col-sm-12">
                            <div class="s-about-content pl-30 wow fadeInRight" data-animation="fadeInRight"
                                 data-delay=".2s">
                                <div class="d-flex justify-content-between">
                                    <h4 class="">
                                        <?= $room['name'] ?>
                                        (Diện tích <?= $room['size'] ?>m²)
                                    </h4>
                                    <h4><?= get_price($room['price']) ?></h4>
                                </div>
                                <p>
                                    <?= nl2br($room['description']) ?>
                                </p>
                                <div class="row">
                                    <div class="col-md-12">
                                        <h5>Các dịch vụ phòng</h5>
                                        <ul class="my-2 row">
                                            <?php foreach ($room['services'] as $service): ?>
                                                <li class="my-0 col-md-4">
                                                    <?= $service['service_name'] ?>
                                                </li>
                                            <?php endforeach; ?>
                                            <li class="my-0 col-md-4">
                                                Số người lớn: <?= $room['adults'] ?>
                                            </li>
                                            <li class="my-0 col-md-4">
                                                Loại giường: <?= $room['loai_giuong'] ?>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-md-12">
                                        <form method="post" action="?ctr=<?= $ctr ?>&act=select_room"
                                              class="d-flex align-items-end">
                                            <input type="hidden" name="id" value="<?= $room['id'] ?>">
                                            <input type="hidden" name="adults" value="<?= $inputCheck['adults'] ?>">
                                            <input type="hidden" name="child" value="<?= $inputCheck['child'] ?>">
                                            <div class="form-group mb-0 me-3">
                                                <label for="">Còn trống</label>
                                                <select name="date" id="" class="form-select">
                                                    <?php foreach ($room['avail'] as $each): ?>
                                                        <option value="<?= $each['checkin'] . '|' . $each['checkout'] ?>">
                                                            <?= get_date_range($each['checkin'], $each['checkout']) ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <button class="btn py-2 px-3 rounded" name="select_room_btn">Đặt phòng này
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

    </div>
</section>
<!--End Project Detail -->
<script>
    $(document).ready(function () {
        $("#form").validate({
            rules: {
                "checkin": {
                    required: true,
                },
                "checkout": {
                    required: true,
                },
                "adults": {
                    required: true,
                },
            },
            messages: {
                "checkin": {
                    required: 'Chọn ngày đến',
                },
                "checkout": {
                    required: 'Chọn ngày đi',
                },
                "adults": {
                    required: 'Chọn số người',
                },
            }
        });
    })
</script>