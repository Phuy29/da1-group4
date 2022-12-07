<?php
if (!empty(session_get('errors'))) {
    $errors = session_get('errors');
    session_delete('errors');
}
if (!empty(session_get('status'))) {
    $status = session_get('status');
    session_delete('status');
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
                <h1 class="auth-title">Thông tin tài khoản</h1>

                <form action="?ctr=<?= $ctr ?? 'home' ?>&act=update" id="form" method="post" class="w-50">
                    <input type="hidden" name="id" value="<?= $user['id'] ?>">
                    <div class="form-group position-relative has-icon-left mb-3">
                        <input
                                type="text"
                                class="form-control form-control-xl"
                                placeholder="Email"
                                name="email"
                                value="<?= $user['email'] ?? '' ?>"
                                disabled
                                readonly
                        >
                        <div class="form-control-icon">
                            <i class="bi bi-envelope"></i>
                        </div>
                    </div>
                    <div class="form-group position-relative mb-3">
                        <input
                                type="text"
                                class="form-control form-control-xl"
                                placeholder="Email"
                                name="email"
                                value="Vai trò: <?= get_role($user['role']) ?>"
                                disabled
                                readonly
                        >
                    </div>
                    <div class="form-group position-relative has-icon-left mb-3">
                        <input
                                type="text"
                                class="form-control form-control-xl"
                                placeholder="Họ và tên"
                                name="fullname"
                                value="<?= $user['fullname'] ?? '' ?>"
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
                                type="text"
                                class="form-control form-control-xl"
                                placeholder="Số điện thoại"
                                name="phone_number"
                                value="<?= $user['phone_number'] ?? '' ?>"
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
                    <button class="btn btn-primary btn-block btn-lg shadow-lg" name="update_user_btn"
                            style="background: #253977;">
                        Cập nhật
                    </button>
                    <div class="text-left mt-3 text-lg fs-5">
                        <p class='text-gray-600 mb-1'>
                            <a href="?ctr=<?= $ctr ?>&act=change_pass" class="font-bold" style="color: #253977;">
                                Đổi mật khẩu
                            </a>
                        </p>
                        <p class='text-gray-600 mb-1'>
                            <a href="?ctr=<?= $ctr ?>&act=forget" class="font-bold" style="color: #253977;">
                                Quên mật khẩu
                            </a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
<script src="public/admin/dist/assets/extensions/sweetalert2/sweetalert2.min.js"></script>
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
    <?php if (!empty($status)) : ?>
    window.onload = () => {
        Swal.fire({
            icon: "<?= $status['type'] ?>",
            title: "<?= $status['title'] ?>",
        })
    }
    <?php endif; ?>
</script>