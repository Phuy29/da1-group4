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
            <form class="form form-vertical" action="?ctr=<?= $ctr ?? 'home' ?>&act=store" method="post"
                  enctype="multipart/form-data" data-parsley-validate>
                <div class="form-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="first-name-vertical">
                                    Tên Chiến Dịch
                                </label>
                                <input
                                        type="text"
                                        id="first-name-vertical"
                                        class="form-control"
                                        name="name"
                                        placeholder="Tên chiến dịch"
                                        data-parsley-required="true"
                                />
                                <?php if (!empty($errors['name']['required'])): ?>
                                    <div class="error text-danger">
                                        <span>Vui lòng nhập trường này</span>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="form-group">
                                <label for="first-name-vertical">
                                    Ngay bat dau
                                </label>
                                  <input
                                        type="date"
                                        id="first-name-vertical"
                                        class="form-control"
                                        name="started_at"
                                        placeholder="Tên chiến dịch"
                                        data-parsley-required="true"
                                />
                                <?php if (!empty($errors['name']['required'])): ?>
                                    <div class="error text-danger">
                                        <span>Vui lòng nhập trường này</span>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="form-group">
                                <label for="first-name-vertical">
                                    Ngay bat dau
                                </label>
                                  <input
                                        type="date"
                                        id="first-name-vertical"
                                        class="form-control"
                                        name="finished_at"
                                        placeholder="Tên chiến dịch"
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
                                    name="chien_dich_create"
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