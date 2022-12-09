<?php
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
                <h1 class="auth-title">Đăng ký</h1>
                <p class="auth-subtitle mb-5">Đăng ký tài khoản để nhận những ưu đãi đặc biệt của RioRelax.</p>

                <form action="?ctr=<?= $ctr ?? 'home' ?>&act=regist" id="form" method="post" class="w-50">
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
                                type="text"
                                class="form-control form-control-xl"
                                placeholder="Họ và tên"
                                name="fullname"
                                value="<?= $data['fullname'] ?? '' ?>"
                        >
                        <div class="form-control-icon">
                            <i class="bi bi-person"></i>
                        </div>
                        <?php if (!empty($errors['fullname'])): ?>
                            <div class="error text-danger">
                                <span><?= $errors['fullname'][0] ?></span>
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
                    <div class="form-group position-relative has-icon-left mb-3">
                        <input
                                type="password"
                                class="form-control form-control-xl"
                                placeholder="Xác nhận mật khẩu"
                                name="repassword"
                                value="<?= $data['repassword'] ?? '' ?>"
                        >
                        <div class="form-control-icon">
                            <i class="bi bi-shield-lock"></i>
                        </div>
                        <?php if (!empty($errors['repassword'])): ?>
                            <div class="error text-danger">
                                <span><?= $errors['repassword'][0] ?></span>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="form-group position-relative has-icon-left mb-3">
                        <input
                                type="text"
                                class="form-control form-control-xl"
                                placeholder="Số điện thoại"
                                name="phone_number"
                                value="<?= $data['phone_number'] ?? '' ?>"
                        >
                        <div class="form-control-icon">
                            <i class="bi bi-telephone"></i>
                        </div>
                        <?php if (!empty($errors['phone_number'])): ?>
                            <div class="error text-danger">
                                <span><?= $errors['phone_number'][0] ?></span>
                            </div>
                        <?php endif; ?>
                    </div>
                    <button class="btn btn-primary btn-block btn-lg shadow-lg" name="signup_btn"
                            style="background: #253977;">
                        Đăng ký
                    </button>
                </form>
                <div class="text-center mt-5 text-lg fs-4">
                    <p class='text-gray-600'>Bạn đã có tài khoản?
                        <a href="?ctr=<?= $ctr ?>&act=signin" class="font-bold" style="color: #253977;">
                            Đăng nhập ngay
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
                "fullname": {
                    required: true,
                    minlength: 3,
                },
                "password": {
                    required: true,
                    minlength: 6,
                },
                "repassword": {
                    equalTo: "#password",
                    required: true,
                },
                "address": {
                    required: true,
                },
                "phone_number": {
                    required: true,
                    minlength: 10,
                }
            },
            messages: {
                "email": {
                    required: 'Vui lòng nhập trường này',
                    email: 'Vui lòng nhập đúng định dạng email',
                },
                "fullname": {
                    required: 'Vui lòng nhập trường này',
                    minlength: 'Không nhập ít hơn 3 ký tự',
                },
                "password": {
                    required: 'Vui lòng nhập trường này',
                    minlength: 'Mật khẩu không ít hơn 6 ký tự',
                },
                "repassword": {
                    required: 'Vui lòng nhập trường này',
                    equalTo: 'Phải khớp với mật khẩu',
                },
                "address": {
                    required: 'Vui lòng nhập trường này',
                },
                "phone_number": {
                    required: 'Vui lòng nhập trường này',
                    minlength: 'Nhập đúng số điện thoại',
                },
            }
        });
    })
</script>