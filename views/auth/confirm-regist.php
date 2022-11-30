<?php
if (!empty(session_get('errors'))) {
    $errors = session_get('errors');
    session_delete('errors');
}
if (!empty(session_get('dataConfirm'))) {
    $dataConfirm = session_get('dataConfirm');
    session_delete('dataConfirm');
}
?>
<!-- breadcrumb-area -->
<?php require 'views/layout/partials/banner.php'; ?>
<!-- breadcrumb-area-end -->
<div id="auth" style="height: fit-content;">
    <div class="row">
        <div class="col-12 py-5">
            <div id="auth-left" class="d-flex flex-column align-items-center p-0">
                <h1 class="auth-title">Nhập mã xác nhận</h1>
                <p class="auth-subtitle mb-5 w-50 text-center">
                    Mã xác nhận gồm 4 chữ số đã được gửi đến email của bạn, vui lòng kiểm tra email (mã có hiệu lực trong 5 phút).
                </p>

                <form action="?ctr=<?= $ctr ?? 'home' ?>&act=confirm_regist_code" id="form" method="post" class="w-50">
                    <div class="form-group position-relative has-icon-left mb-3">
                        <input
                                type="text"
                                class="form-control form-control-xl"
                                placeholder="VD: 2611"
                                name="verify_code"
                                value="<?= $data['verify_code'] ?? '' ?>"
                        >
                        <div class="form-control-icon">
                            <i class="bi bi-envelope"></i>
                        </div>
                        <?php if (!empty($errors['verify_code'])): ?>
                            <div class="error text-danger">
                                <span><?= $errors['verify_code'][0] ?></span>
                            </div>
                        <?php endif; ?>
                    </div>
                    <button class="btn btn-primary btn-block btn-lg shadow-lg mt-2" name="confirm_btn"
                            style="background: #253977;">
                        Xác nhận
                    </button>
                </form>
            </div>
        </div>
    </div>

</div>
<script>
    $(document).ready(function () {
        $("#form").validate({
            rules: {
                "verify_code": {
                    required: true,
                    equalTo: 4,
                },
            },
            messages: {
                "verify_code": {
                    required: 'Vui lòng nhập trường này',
                    equalTo: 'Mã xác nhận phải là 4 ký tự',
                },
            }
        });
    })
</script>