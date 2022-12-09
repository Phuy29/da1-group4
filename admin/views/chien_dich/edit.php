<?php
if (!empty(session_get('errors'))) {
    $errors = session_get('errors');
    session_delete('errors');
}
?>
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Form thêm chiến dịch</h4>
    </div>
    <div class="card-content">
        <div class="card-body">
            <form class="form form-vertical" action="?ctr=<?= $ctr ?? 'home' ?>&act=update" method="post"
                  enctype="multipart/form-data" data-parsley-validate>
                <div class="form-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="first-name-vertical">
                                    Mã chiến dịch
                                </label>
                                <input
                                        type="text"
                                        id="first-name-vertical"
                                        class="form-control"
                                        name="name"
                                        placeholder="Tên chiến dịch"
                                        disabled
                                        value="<?= $item['id'] ?? '' ?>"
                                />
                                <input type="hidden" name="id" value="<?= $item['id'] ?? '' ?>">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="first-name-vertical">
                                    Tên chiến dịch
                                </label>
                                <input
                                        type="text"
                                        id="first-name-vertical"
                                        class="form-control"
                                        name="name"
                                        placeholder="Tên chiến dịch"
                                        value="<?= $item['name'] ?? '' ?>"
                                        data-parsley-required="true"
                                />
                                <?php if (!empty($errors['name'])): ?>
                                    <div class="error text-danger">
                                        <span><?= $errors['name'][0] ?></span>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <label for="first-name-vertical">
                                    Ngày bắt đầu
                                </label>
                                <input
                                        type="date"
                                        id="first-name-vertical"
                                        class="form-control"
                                        name="started_at"
                                        placeholder="Tên chiến dịch"
                                        data-parsley-required="true"
                                        value="<?= $item['started_at'] ?? '' ?>"
                                />
                                <?php if (!empty($errors['started_at'])): ?>
                                    <div class="error text-danger">
                                        <span><?= $errors['started_at'][0] ?></span>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <label for="first-name-vertical">
                                    Ngày kết thúc
                                </label>
                                <input
                                        type="date"
                                        id="first-name-vertical"
                                        class="form-control"
                                        name="finished_at"
                                        placeholder="Tên chiến dịch"
                                        data-parsley-required="true"
                                        value="<?= $item['finished_at'] ?? '' ?>"
                                />
                                <?php if (!empty($errors['finished_at'])): ?>
                                    <div class="error text-danger">
                                        <span><?= $errors['finished_at'][0] ?></span>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-12 d-flex justify-content-end">
                            <button
                                    type="submit"
                                    class="btn btn-primary me-1 mb-1"
                                    name="chien_dich_edit"
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