<?php
//var_dump(cookie_get('verifyCode'));
//die();
if (!empty(session_get('errors'))) {
    $errors = session_get('errors');
    session_delete('errors');
}
if (!empty(session_get('data'))) {
    $data = session_get('data');
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
                <h1 class="auth-title">Đăng nhập</h1>
                <p class="auth-subtitle mb-5">Đăng nhập vào ZCube.</p>

                <form action="?ctr=<?= $ctr ?? 'home' ?>&act=process_signin" id="form" method="post" class="w-50">
                    <div class="form-group position-relative has-icon-left mb-3">
                        <input
                                type="text"
                                class="form-control form-control-xl"
                                placeholder="Email"
                                name="email"
                                value="<?= $data['email'] ?? '' ?>"
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
                                id="password"
                                placeholder="Mật khẩu"
                                name="password"
                                value="<?= $data['password'] ?? '' ?>"
                        >
                        <div class="form-control-icon">
                            <i class="bi bi-shield-lock"></i>
                        </div>
                        <?php if (!empty($errors['password'])): ?>
                            <div class="error text-danger">
                                <span><?= $errors['password'][0] ?></span>
                            </div>
                        <?php endif; ?>
                    </div>
                    <button class="btn btn-primary btn-block btn-lg shadow-lg" name="signin_btn"
                            style="background: #253977;">
                        Đăng nhập
                    </button>
                </form>
                <div class="text-center mt-5 text-lg fs-4">
                    <p class='text-gray-600'>Bạn chưa có tài khoản?
                        <a href="?ctr=<?= $ctr ?>&act=signup" class="font-bold" style="color: #253977;">
                            Đăng ký ngay
                        </a>.
                    </p>
                </div>
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
                "password": {
                    required: true,
                    minlength: 6,
                },
            },
            messages: {
                "email": {
                    required: 'Vui lòng nhập trường này',
                    email: 'Vui lòng nhập đúng định dạng email',
                },
                "password": {
                    required: 'Vui lòng nhập trường này',
                    minlength: 'Mật khẩu không ít hơn 6 ký tự',
                },
            }
        });
    })
</script>