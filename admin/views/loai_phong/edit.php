<?php
if (!empty(session_get('errors'))) {
    $errors = session_get('errors');
    session_delete('errors');
}
?>
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Form thêm dịch vụ phòng</h4>
    </div>
    <div class="card-content">
        <div class="card-body">
            <form class="form form-vertical" action="?ctr=<?= $ctr ?? 'home' ?>&act=update" method="post" enctype="multipart/form-data" data-parsley-validate>
                <div class="form-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="first-name-vertical">
                                    Mã dịch vụ
                                </label>
                                <input
                                        type="text"
                                        id="first-name-vertical"
                                        class="form-control"
                                        name="name"
                                        placeholder="Tên dịch vụ"
                                        disabled
                                        value="<?= $item['id'] ?? '' ?>"
                                />
                                <input type="hidden" name="id" value="<?= $item['id'] ?? '' ?>">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="first-name-vertical">
                                    Tên dịch vụ
                                </label>
                                <input
                                        type="text"
                                        id="first-name-vertical"
                                        class="form-control"
                                        name="name"
                                        placeholder="Tên dịch vụ"
                                        value="<?= $item['name'] ?? '' ?>"
                                        data-parsley-required="true"
                                />
                                <?php if (!empty($errors['name']['required'])): ?>
                                    <div class="error text-danger">
                                        <span>Vui lòng nhập trường này</span>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-12 d-flex justify-content-end">
                            <button
                                    type="submit"
                                    class="btn btn-primary me-1 mb-1"
                                    name="dich_vu_phong_edit"
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
