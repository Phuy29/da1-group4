<?php
$campaign = [
    [
        'id' => 1,
        'name' => 'Giáng sinh',
        'started_at' => '2022-12-23',
        'finished_at' => '2022-12-26',
    ],
    [
        'id' => 2,
        'name' => 'Tết Dương lịch',
        'started_at' => '2022-12-29',
        'finished_at' => '2023-01-02',
    ]
];
$status = [
    [
        'id' => 1,
        'name' => 'Vô hạn',
    ],
    [
        'id' => 2,
        'name' => 'Hữu hạn',
    ],

];
if (!empty(session_get('errors'))) {
    $errors = session_get('errors');
    session_delete('errors');
}
?>
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Form tạo voucher</h4>
    </div>
    <div class="card-content">
        <div class="card-body">
            <form class="form form-vertical" action="?ctr=<?= $ctr ?? 'home' ?>&act=store" method="post"
                  enctype="multipart/form-data" data-parsley-validate>
                <div class="form-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="first-name-vertical">
                                    Số lượng
                                </label>
                                <input
                                        type="text"
                                        id="first-name-vertical"
                                        class="form-control"
                                        name="quantity"
                                        placeholder="Số lượng"
                                        data-parsley-required="true"
                                />
                                <?php if (!empty($errors['quantity'])): ?>
                                    <div class="error text-danger">
                                        <span><?= $errors['quantity'][0] ?></span>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="first-name-vertical">
                                    Giảm giá (%)
                                </label>
                                <input
                                        type="text"
                                        id="first-name-vertical"
                                        class="form-control"
                                        name="discount"
                                        placeholder="% giảm giá"
                                        data-parsley-required="true"
                                />
                                <?php if (!empty($errors['discount'])): ?>
                                    <div class="error text-danger">
                                        <span><?= $errors['discount'][0] ?></span>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="first-name-vertical">
                                    Loại muốn tạo
                                </label>
                                <select class="form-select" name="status" id="status">
                                    <?php foreach ($status as $each) { ?>
                                        <option value="<?= $each['id'] ?>">
                                            <?= $each['name'] ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="first-name-vertical">
                                    Chiến dịch
                                </label>
                                <select class="form-select" name="campaign_id" id="campaign_id">
                                    <?php foreach ($campaign as $each) { ?>
                                        <option value="<?= $each['id'] ?>">
                                            <?= $each['name'] ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 d-flex justify-content-end">
                            <button
                                    type="submit"
                                    class="btn btn-primary me-1 mb-1"
                                    name="voucher_create"
                            >
                                Thêm
                            </button>
                            <button
                                    type="reset"
                                    class="btn btn-light-secondary me-1 mb-1"
                            >
                                Reset
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="../public/admin/dist/assets/extensions/parsleyjs/parsley.min.js"></script>
<script src="../public/admin/dist/assets/js/pages/parsley.js"></script>