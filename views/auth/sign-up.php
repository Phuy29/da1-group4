<!-- breadcrumb-area -->
<?php require 'views/layout/partials/banner.php'; ?>
<!-- breadcrumb-area-end -->
<div id="auth" style="height: fit-content;">
    <div class="row">
        <div class="col-lg-5 col-12">
            <div id="auth-left">
                <div class="auth-logo">
                    <a href="index.html"><img src="public/admin/dist/assets/images/logo/logo.svg" alt="Logo"></a>
                </div>
                <h1 class="auth-title">Sign Up</h1>
                <p class="auth-subtitle mb-5">Input your data to register to our website.</p>

                <form action="?ctr=auth&act=regist" id="form" method="post">
                    <div class="form-group position-relative has-icon-left mb-4">
                        <input type="text" class="form-control form-control-xl" placeholder="Email" name="email">
                        <div class="form-control-icon">
                            <i class="bi bi-envelope"></i>
                        </div>
                    </div>
                    <div class="form-group position-relative has-icon-left mb-4">
                        <input type="text" class="form-control form-control-xl" placeholder="Fullname" name="fullname">
                        <div class="form-control-icon">
                            <i class="bi bi-person"></i>
                        </div>
                    </div>
                    <div class="form-group position-relative has-icon-left mb-4">
                        <input type="password" class="form-control form-control-xl" id="password" placeholder="Password"
                               name="password">
                        <div class="form-control-icon">
                            <i class="bi bi-shield-lock"></i>
                        </div>
                    </div>
                    <div class="form-group position-relative has-icon-left mb-4">
                        <input type="password" class="form-control form-control-xl" placeholder="Confirm Password"
                               name="repassword">
                        <div class="form-control-icon">
                            <i class="bi bi-shield-lock"></i>
                        </div>
                    </div>
                    <div class="form-group position-relative has-icon-left mb-4">
                        <input type="text" class="form-control form-control-xl" placeholder="Address" name="address">
                        <div class="form-control-icon">
                            <i class="bi bi-cursor"></i>
                        </div>
                    </div>
                    <div class="form-group position-relative has-icon-left mb-4">
                        <input type="text" class="form-control form-control-xl" placeholder="Tel" name="phone_number">
                        <div class="form-control-icon">
                            <i class="bi bi-telephone"></i>
                        </div>
                    </div>
                    <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5" style="background: #253977;">Sign
                        Up
                    </button>
                </form>
                <div class="text-center mt-5 text-lg fs-4">
                    <p class='text-gray-600'>Already have an account? <a href="auth-login.html" class="font-bold"
                                                                         style="color: #253977;">Log
                            in</a>.</p>
                </div>
            </div>
        </div>
        <div class="col-lg-7 d-none d-lg-block">
            <div id="auth-right">

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
                    minlength: 3,
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
                    minlength: 'Không nhập ít hơn 3 ký tự',
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