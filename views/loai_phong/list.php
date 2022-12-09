<!-- breadcrumb-area -->
<?php require 'views/layout/partials/banner.php'; ?>
<!-- room-area-->
<section id="services" class="services-area pt-120 pb-90">

    <div class="container">

        <div class="row">
            <?php foreach ($room_types as $room_type): ?>
                <div class="col-xl-4 col-md-6">
                    <div class="single-services ser-m mb-30">
                        <div class="services-thumb">
                            <a class="gallery-link" href="?ctr=<?= $ctr ?>&act=detail&id=<?= $room_type['id'] ?>">
                                <img src="public/img/gallery/room-img01.png" alt="img">
                            </a>
                        </div>
                        <div class="services-content">
                            <div class="day-book">
                                <ul>
                                    <li><?= get_price($room_type['price']) ?>/Ngày</li>
                                    <li><a href="?ctr=<?= $ctr ?>&act=detail&id=<?= $room_type['id'] ?>">Xem ngay</a>
                                    </li>
                                </ul>
                            </div>
                            <h4>
                                <a href="?ctr=<?= $ctr ?>&act=detail&id=<?= $room_type['id'] ?>">
                                    <?= limit_word($room_type['name'], 21) ?>
                                </a>
                            </h4>
                            <p>
                                <?= limit_word($room_type['description'], 200) ?>
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
<section class="booking pt-120 pb-120 p-relative fix">
    <div class="animations-01"><img src="public/img/bg/an-img-01.png" alt="an-img-01"></div>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-6">
                <div class="contact-bg02">
                    <div class="section-title center-align">
                        <h5>Sử dụng dịch vụ của chúng tôi</h5>
                        <h2>
                            Hãy đặt 1 phòng
                        </h2>
                    </div>
                    <form action="https://zcube.in/riorelax/mail.php" method="post" class="contact-form mt-30">
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <div class="contact-field p-relative c-name mb-20">
                                    <label><i class="fal fa-badge-check"></i> Ngày bắt đầu</label>
                                    <input type="date" id="chackin2" name="date">
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6">
                                <div class="contact-field p-relative c-subject mb-20">
                                    <label><i class="fal fa-times-octagon"></i> Ngày rời đi</label>
                                    <input type="date" id="chackout2" name="date">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="contact-field p-relative c-subject mb-20">
                                    <label><i class="fal fa-users"></i> Số người lớn</label>
                                    <select name="adults" id="adu2">
                                        <option value="sports-massage">Số người lớn</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="contact-field p-relative c-option mb-20">
                                    <label><i class="fal fa-concierge-bell"></i> Loại phòng</label>
                                    <select name="room" id="rm2">
                                        <option value="sports-massage">Loại phòng</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="slider-btn mt-15">
                                    <button class="btn ss-btn" data-animation="fadeInRight" data-delay=".8s"><span>Tìm phòng</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
            <div class="col-lg-6 col-md-6">
                <div class="booking-img">
                    <img src="public/img/bg/booking-img.png" alt="img">
                </div>
            </div>
        </div>
    </div>
</section>
<!-- booking-area-end -->
<!-- breadcrumb-area-end -->