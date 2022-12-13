<?php
if (!empty(session_get('status'))) {
    $status = session_get('status');
    session_delete('status');
}

if (!empty(session_get('errors'))) {
    $errors = session_get('errors');
    session_delete('errors');
}
if (!empty(session_get('inputCheck'))) {
    $inputCheck = session_get('inputCheck');
    session_delete('inputCheck');
}
?>
<!-- slider-area -->
<section id="home" class="slider-area fix p-relative">

    <div class="slider-active" style="background: #101010;">
        <div class="single-slider slider-bg d-flex align-items-center"
             style="background-image: url(public/img/slider/slider_bg.png); background-size: cover;">
            <div class="container">
                <div class="row justify-content-center align-items-center">

                    <div class="col-lg-7 col-md-7">
                        <div class="slider-content s-slider-content mt-80 text-center">
                            <h2 data-animation="fadeInUp" class="fs-2" data-delay=".4s">Tận hưởng những trải nghiệm sang
                                trọng nhất</h2>
                            <p data-animation="fadeInUp" data-delay=".6s">
                                Chúng tôi cung cấp tới bạn những dịch vụ hiện đại và thoải mái nhất
                            </p>

                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="single-slider slider-bg d-flex align-items-center"
             style="background-image: url(public/img/slider/slider_bg_01.png); background-size: cover;">
            <div class="container">
                <div class="row justify-content-center align-items-center">

                    <div class="col-lg-7 col-md-7">
                        <div class="slider-content s-slider-content mt-80 text-center">
                            <h2 data-animation="fadeInUp" class="fs-2" data-delay=".4s">Tận hưởng những trải nghiệm sang
                                trọng nhất</h2>
                            <p data-animation="fadeInUp" data-delay=".6s">
                                Chúng tôi cung cấp tới bạn những dịch vụ hiện đại và thoải mái nhất
                            </p>

                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>


</section>
<!-- slider-area-end -->
<!-- booking-area -->
<div id="booking" class="booking-area p-relative">
    <div class="container">
        <form action="?ctr=dat_phong&act=check_available_home" id="form" method="post" class="contact-form form">
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
                                <select class="form-control" name="adults" id="adu">
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
                                <select class="form-control" name="child" id="cld">
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
<!-- about-area -->
<?php require_once 'views/about-area.php'; ?>
<!-- about-area-end -->
<!-- room-area-->
<section id="services" class="services-area pt-113 pb-150">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-12">
                <div class="section-title center-align mb-50 text-center">
                    <h5>Những phòng nghỉ sang trọng</h5>
                    <h2>Các loại phòng của chúng tôi</h2>
                    <p>
                        "Nơi lý tưởng cho các sự kiện lớn. Đến với khu nghỉ dưỡng này, điều mà mình có được không chỉ là
                        sự nghỉ ngơi, thư gian, mà đây còn là nơi gắn kết mọi người nhờ không gian đủ cho các loại sự
                        kiện. Giá cả tất nhiên là tương ứng với giá dịch vụ."
                    </p>
                </div>
            </div>
        </div>
        <div class="row services-active">
            <?php foreach ($room_types as $room_type): ?>
                <div class="col-xl-4 col-md-6">
                    <div class="single-services mb-30">
                        <div class="services-thumb">
                            <a href="?ctr=loai_phong&act=detail&id=<?= $room_type['id'] ?>">
                                <img src="public/img/gallery/room-img01.png" alt="img">
                            </a>
                        </div>
                        <div class="services-content">
                            <div class="day-book">
                                <ul>
                                    <li><?= get_price($room_type['price']) ?>/Ngày</li>
                                    <li><a href="?ctr=loai_phong&act=detail&id=<?= $room_type['id'] ?>">Xem ngay</a>
                                    </li>
                                </ul>
                            </div>
                            <h4>
                                <a href="?ctr=loai_phong&act=detail&id=<?= $room_type['id'] ?>"><?= limit_word($room_type['name'], 21) ?></a>
                            </h4>
                            <p>
                                <?= limit_word($room_type['description'], 100) ?>
                            </p>
                            <div class="icon">
                                <ul>
                                    <li><img src="public/img/icon/sve-icon1.png" alt="img"></li>
                                    <li><img src="public/img/icon/sve-icon2.png" alt="img"></li>
                                    <li><img src="public/img/icon/sve-icon3.png" alt="img"></li>
                                    <li><img src="public/img/icon/sve-icon4.png" alt="img"></li>
                                    <li><img src="public/img/icon/sve-icon5.png" alt="img"></li>
                                    <li><img src="public/img/icon/sve-icon6.png" alt="img"></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<!-- room-area-end -->

<!-- booking-area -->
<?php require_once 'views/booking-area.php'; ?>
<!-- booking-area-end -->
<!-- brand-area -->
<div class="brand-area pt-60 pb-60" style="background-color:#f7f5f1">
    <div class="container">
        <div class="row brand-active">
            <div class="col-xl-2">
                <div class="single-brand">
                    <img src="public/img/brand/b-logo1.png" alt="img">
                </div>
            </div>
            <div class="col-xl-2">
                <div class="single-brand">
                    <img src="public/img/brand/b-logo2.png" alt="img">
                </div>
            </div>
            <div class="col-xl-2">
                <div class="single-brand">
                    <img src="public/img/brand/b-logo3.png" alt="img">
                </div>
            </div>
            <div class="col-xl-2">
                <div class="single-brand">
                    <img src="public/img/brand/b-logo4.png" alt="img">
                </div>
            </div>
            <div class="col-xl-2">
                <div class="single-brand">
                    <img src="public/img/brand/b-logo5.png" alt="img">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- brand-area-end -->
<script src="public/admin/dist/assets/extensions/sweetalert2/sweetalert2.min.js"></script>
<script>
    $(document).ready(function () {
        $(".form").validate({
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
    <?php if (!empty($status)) : ?>
    window.onload = () => {
        Swal.fire({
            icon: "<?= $status['type'] ?>",
            title: "<?= $status['title'] ?>",
        })
    }
    <?php endif; ?>
</script>