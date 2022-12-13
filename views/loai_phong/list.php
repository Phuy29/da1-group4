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
<!-- breadcrumb-area-end -->