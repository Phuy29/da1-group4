<?php
if (!empty(session_get('errors'))) {
    $errors = session_get('errors');
    session_delete('errors');
}
if (!empty(session_get('user_session'))) {
    $email = session_get('user_session')['email'];
}
if (!empty(session_get('data'))) {
    $data = session_get('data');
    $email = $data['email'];
    session_delete('data');
}
?>
<!-- breadcrumb-area -->
<?php require 'views/layout/partials/banner.php'; ?>
<!-- breadcrumb-area-end -->
<div id="auth" style="height: fit-content;">
    <div class="row">
        <div class="col-12 py-5">
            <div id="auth-left" class="d-flex flex-column align-items-center p-0">
                <h1 class="auth-title">Quên mật khẩu</h1>

                <form action="?ctr=<?= $ctr ?>&act=check_forget" id="form" method="post" class="w-50">
                    <div class="form-group position-relative has-icon-left mb-3">
                        <input
                                type="text"
                                class="form-control form-control-xl"
                                placeholder="Email"
                                name="email"
                                value="<?= $email ?? '' ?>"
                        >
                        <div class="form-control-icon">
                            <i class="bi bi-envelope"></i>
                        </div>
                        <?php if (!empty($errors['email'])): ?>
                            <div class="error text-danger">
                                <span><?= $errors['email'][0] ?></span>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="form-group position-relative has-icon-left mb-3">
                        <input
                                type="password"
                                class="form-control form-control-xl"
                                id="new_password"
                                placeholder="Mật khẩu mới"
                                name="new_password"
                                value="<?= $data['new_password'] ?? '' ?>"
                        >
                        <div class="form-control-icon">
                            <i class="bi bi-shield-lock"></i>
                        </div>
                        <?php if (!empty($errors['new_password'])): ?>
                            <div class="error text-danger">
                                <span><?= $errors['new_password'][0] ?></span>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="form-group position-relative has-icon-left mb-3">
                        <input
                                type="password"
                                class="form-control form-control-xl"
                                placeholder="Xác nhận mật khẩu mới"
                                name="re_new_password"
                                value="<?= $data['re_new_password'] ?? '' ?>"
                        >
                        <div class="form-control-icon">
                            <i class="bi bi-shield-lock"></i>
                        </div>
                        <?php if (!empty($errors['re_new_password'])): ?>
                            <div class="error text-danger">
                                <span><?= $errors['re_new_password'][0] ?></span>
                            </div>
                        <?php endif; ?>
                    </div>
                    <button class="btn btn-primary btn-block btn-lg shadow-lg" name="forget_pass_btn"
                            style="background: #253977;">
                        Quên mật khẩu
                    </button>
                    <div class="text-left mt-3 text-lg fs-5">
                        <p class='text-gray-600 mb-1'>
                            <a href="?ctr=<?= $ctr ?>&act=change_pass" class="font-bold" style="color: #253977;">
                                Đổi mật khẩu
                            </a>
                        </p>
                        <p class='text-gray-600 mb-1'>Bạn đã có tài khoản?
                            <a href="?ctr=<?= $ctr ?>&act=signin" class="font-bold" style="color: #253977;">
                                Đăng nhập ngay
                            </a>.
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
<script>
    $(document).ready(function () {
        $("#form").validate({
            rules: {
                "email": {
                    required: true,
                    email: true,
                },
                "old_password": {
                    required: true,
                    minlength: 6,
                },
                "new_password": {
                    required: true,
                    minlength: 6,
                },
                "re_new_password": {
                    equalTo: "#new_password",
                    required: true,
                },
            },
            messages: {
                "email": {
                    required: 'Vui lòng nhập trường này',
                    email: 'Vui lòng nhập đúng định dạng email',
                },
                "old_password": {
                    required: 'Vui lòng nhập trường này',
                    minlength: 'Mật khẩu không ít hơn 6 ký tự',
                },
                "new_password": {
                    required: 'Vui lòng nhập trường này',
                    minlength: 'Mật khẩu không ít hơn 6 ký tự',
                },
                "re_new_password": {
                    required: 'Vui lòng nhập trường này',
                    equalTo: 'Phải khớp với mật khẩu',
                },
            }
        });
    })
</script>