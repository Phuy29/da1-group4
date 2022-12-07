<?php
if (!empty(session_get('errors'))) {
    $errors = session_get('errors');
    session_delete('errors');
}
?>
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Form gửi ưu đãi</h4>
    </div>
    <div class="card-content">
        <div class="card-body">
            <form class="form form-vertical" action="?ctr=<?= $ctr ?? 'home' ?>&act=process_send" method="post"
                  enctype="multipart/form-data">
                <div class="form-body">
                    <div class="row">
                        <input type="hidden" name="code" value="<?= $voucher['code'] ?>">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="first-name-vertical">
                                    Code
                                </label>
                                <input
                                        type="text"
                                        id="first-name-vertical"
                                        class="form-control"
                                        name=""
                                        value="<?= $voucher['code'] ?>"
                                        disabled
                                        readonly="true"
                                />
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="first-name-vertical">
                                    Giảm giá
                                </label>
                                <input
                                        type="text"
                                        id="first-name-vertical"
                                        class="form-control"
                                        name=""
                                        value="<?= $voucher['discount'] ?>%"
                                        disabled
                                        readonly="true"
                                />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="first-name-vertical">
                                    Chiến dịch
                                </label>
                                <input
                                        type="text"
                                        id="first-name-vertical"
                                        class="form-control"
                                        name=""
                                        value="<?= $voucher['campaign_name'] ?>"
                                        disabled
                                        readonly="true"
                                />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="first-name-vertical">
                                    Gửi đến
                                </label>
                                <select class="form-select" name="send_to" id="">
                                    <option value="all">Tất cả khách hàng</option>
                                    <?php foreach ($emails as $email) { ?>
                                        <option value="<?= $email ?>">
                                            <?= $email ?>
                                        </option>
                                    <?php } ?>
                                </select>
                                <?php if (!empty($errors['discount'])): ?>
                                    <div class="error text-danger">
                                        <span><?= $errors['discount'][0] ?></span>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="title">Tiêu đề</label>
                                <input name="title" id="" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="title">Nội dung</label>
                                <textarea name="content" id="" cols="30" rows="4" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="col-12 d-flex justify-content-end">
                            <button
                                    type="submit"
                                    class="btn btn-primary me-1 mb-1"
                                    name="voucher_send_btn"
                            >
                                Gửi
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
<script>
    $(document).ready(function () {
        $(".form").validate({
            rules: {
                "title": {
                    required: true
                },
                "content": {
                    required: true
                }
            },
            messages: {
                title: {
                    required: 'Vui lòng nhập tiêu đề'
                },
                content: {
                    required: 'Vui lòng nhập nội dung'
                }
            }
        });
    })
</script>