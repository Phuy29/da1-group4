<?php require_once 'views/layout/partials/sidebar.php'; ?>
<div id="main">
    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>

    <div class="page-heading">
        <h3><?= $page_title ?? 'Dashboard' ?></h3>
        <a href="<?= _BASE_URL ?>" class="">Về trang chủ</a>
    </div>
    <div class="page-content">
        <?= @$content; ?>
    </div>

</div>