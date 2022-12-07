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
<!-- room-area-->
<div class="about-area5 about-p p-relative">
    <div class="container pt-120 pb-40">
        <div class="row">
            <!-- #right side -->
            <div class="col-sm-12 col-md-12 col-lg-4 order-2">
                <aside class="sidebar services-sidebar">

                    <!-- Category Widget -->
                    <div class="sidebar-widget categories">
                        <div class="widget-content">
                            <h2 class="widget-title"> Kiểm tra phòng </h2>
                            <!-- Services Category -->
                            <!-- booking-area -->
                            <div class="booking">
                                <div class="contact-bg">
                                    <form action="?ctr=dat_phong&act=check_available_home" id="form" method="post"
                                          class="contact-form mt-30">
                                        <input type="hidden" name="room_type_id" value="<?= $room['id'] ?>">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="contact-field p-relative c-name mb-20">
                                                    <label><i class="fal fa-badge-check"></i> Ngày bắt đầu</label>
                                                    <input type="date" id="checkin" name="checkin"
                                                           value="<?= $inputCheck['checkin'] ?? '' ?>">
                                                    <?php if (!empty($errors['checkin'])): ?>
                                                        <div class="error text-danger">
                                                            <span><?= $errors['checkin'][0] ?></span>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>

                                            <div class="col-lg-12">
                                                <div class="contact-field p-relative c-subject mb-20">
                                                    <label><i class="fal fa-times-octagon"></i> Ngày rời đi</label>
                                                    <input type="date" id="checkout" name="checkout"
                                                           value="<?= $inputCheck['checkout'] ?? '' ?>">
                                                    <?php if (!empty($errors['checkout'])): ?>
                                                        <div class="error text-danger">
                                                            <span><?= $errors['checkout'][0] ?></span>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="contact-field p-relative c-subject mb-20">
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
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="contact-field p-relative c-subject mb-20">
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
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="slider-btn mt-15">
                                                    <button name="check_btn" class="btn ss-btn"
                                                            data-animation="fadeInRight"
                                                            data-delay=".8s"><span>Kiểm tra phòng</span></button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- booking-area-end -->
                        </div>
                    </div>
                    <!--Service Contact-->
                    <!--                    <div class="service-detail-contact wow fadeup-animation" data-wow-delay="1.1s">-->
                    <!--                        <h3 class="h3-title">If You Need Any Help Contact With Us</h3>-->
                    <!--                        <a href="javascript:void(0);" title="Call now">+91 705 2101 786</a>-->
                    <!--                    </div>-->

                </aside>
            </div>
            <!-- #right side end -->


            <div class="col-lg-8 col-md-12 col-sm-12 order-1">
                <div class="service-detail">
                    <div class="content-box">
                        <div class="row align-items-center mb-50">
                            <div class="col-lg-6 col-md-6">
                                <div class="price">
                                    <h2><?= $room['name'] ?></h2>
                                    <span><?= get_price($room['price']) ?>/Ngày</span>
                                </div>
                            </div>
                            <div class="col-lg-6 text-right">
                                <img src="public/img/testimonial/review-icon.png" alt="img">
                            </div>
                        </div>
                        <div class="image-slider mb-5" style="height: 500px;">
                            <?php foreach ($room['images'] as $image): ?>
                                <div style="background: url(); background-size: cover; height: 500px;">
                                    <img class="img-main" style="object-fit: fill !important; height: 100% !important;"
                                         src="<?= $image['image'] ?>" alt="">
                                </div>
                            <?php endforeach; ?>
                        </div>


                        <p>
                            <?= nl2br($room['description']) ?>
                        </p>
                        <h3>Dịch vụ phòng</h3>
                        <ul class="room-features d-flex align-items-center">
                            <?php foreach ($room['services'] as $service): ?>
                                <li>
                                    <?= $service['service_name'] ?>
                                </li>
                            <?php endforeach; ?>
                            <li>
                                Người lớn: <?= $room['adults'] ?>
                            </li>
                            <li>
                                Diện tích: <?= $room['size'] ?>m²
                            </li>
                            <li>
                                Loại giường: <?= $room['loai_giuong'] ?>
                            </li>

                        </ul>
                        <h3>Về trẻ em</h3>
                        <p>
                            Chúng tôi không tính phí trẻ em
                        </p>
                        <!--                        <div class="mb-50">-->
                        <!--                            <a href="contact.html" class="btn ss-btn">Đặt phòng này</a>-->
                        <!--                        </div>-->


                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- service-details-area-end -->

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