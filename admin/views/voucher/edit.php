<?php
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
        <h4 class="card-title">Form sửa voucher</h4>
    </div>
    <div class="card-content">
        <div class="card-body">
            <form class="form form-vertical" action="?ctr=<?= $ctr ?? 'home' ?>&act=update" method="post"
                  enctype="multipart/form-data" data-parsley-validate>
                <div class="form-body">
                    <div class="row">
                        <input type="hidden" name="id" value="<?= $item['id'] ?>">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="first-name-vertical">
                                    ID
                                </label>
                                <input
                                        type="text"
                                        id="first-name-vertical"
                                        class="form-control"
                                        name=""
                                        value="<?= $item['id'] ?>"
                                        disabled
                                        readonly="true"
                                />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="first-name-vertical">
                                    Code
                                </label>
                                <input
                                        type="text"
                                        id="first-name-vertical"
                                        class="form-control"
                                        name=""
                                        value="<?= $item['code'] ?>"
                                        disabled
                                        readonly="true"
                                />
                            </div>
                        </div>
                        <div class="col-md-4">
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
                                        value="<?= $item['discount'] ?>"
                                />
                                <?php if (!empty($errors['discount'])): ?>
                                    <div class="error text-danger">
                                        <span><?= $errors['discount'][0] ?></span>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="first-name-vertical">
                                    Loại muốn tạo
                                </label>
                                <select class="form-select" name="status" id="status">
                                    <?php foreach ($status as $each) { ?>
                                        <option value="<?= $each['id'] ?>"
                                            <?php if ($item['status'] == $each['id']): ?>
                                                selected
                                            <?php endif; ?>
                                        >
                                            <?= $each['name'] ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="first-name-vertical">
                                    Chiến dịch
                                </label>
                                <select class="form-select" name="campaign_id" id="campaign_id">
                                    <?php foreach ($campaigns as $each) { ?>
                                        <option value="<?= $each['id'] ?>"
                                            <?php if ($item['campaign_id'] == $each['id']): ?>
                                                selected
                                            <?php endif; ?>
                                        >
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
                                    name="voucher_edit"
                            >
                                Sửa
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