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

<!-- add before </body> -->
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Form thêm loại phòng</h4>
    </div>
    <div class="card-content">
        <div class="card-body">
            <form class="form form-vertical" action="?ctr=<?= $ctr ?? 'home' ?>&act=store" method="post"
                  enctype="multipart/form-data">
                <div class="form-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="first-name-vertical">
                                    Tên loại phòng
                                </label>
                                <input
                                        type="text"
                                        id="first-name-vertical"
                                        class="form-control"
                                        name="name"
                                        placeholder="Tên loại phòng"
                                        value="<?= $data['name'] ?? '' ?>"
                                />
                                <?php if (!empty($errors['name'])): ?>
                                    <div class="error text-danger">
                                        <span><?= $errors['name'][0] ?></span>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="adult">
                                    Số người lớn
                                </label>
                                <input
                                        type="text"
                                        id="adult"
                                        class="form-control"
                                        name="adults"
                                        placeholder="Số người lớn"
                                        value="<?= $data['adults'] ?? '' ?>"
                                />
                                <?php if (!empty($errors['adults'])): ?>
                                    <div class="error text-danger">
                                        <span><?= $errors['adults'][0] ?></span>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="size">
                                    Diện tích
                                </label>
                                <input
                                        type="text"
                                        id="size"
                                        class="form-control"
                                        name="size"
                                        placeholder="Diện tích"
                                        value="<?= $data['size'] ?? '' ?>"
                                />
                                <?php if (!empty($errors['size'])): ?>
                                    <div class="error text-danger">
                                        <span><?= $errors['size'][0] ?></span>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="bed_type_id">
                                    Loại giường
                                </label>
                                <select name="bed_type_id" class="form-select" id="bed_type_id">
                                    <?php foreach ($bed_types as $bed_type): ?>
                                        <option value="<?= $bed_type['id'] ?>"

                                            <?php if (!empty($data['bed_type_id']) && $bed_type['id'] == $data['bed_type_id']): ?>
                                                selected
                                            <?php endif; ?>
                                        >
                                            <?= $bed_type['name'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="price">
                                    Giá ($)
                                </label>
                                <input
                                        type="text"
                                        id="price"
                                        class="form-control"
                                        name="price"
                                        placeholder="Giá"
                                        value="<?= $data['price'] ?? '' ?>"
                                />
                                <?php if (!empty($errors['price'])): ?>
                                    <div class="error text-danger">
                                        <span><?= $errors['price'][0] ?></span>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label class="mb-2 form-label" for="">
                                    Dịch vụ
                                </label>
                                <ul class="list-unstyled mb-0">
                                    <?php foreach ($room_services as $room_service): ?>
                                        <li class="d-inline-block me-4 mb-1">
                                            <div class="form-check">
                                                <div class="checkbox">
                                                    <input
                                                            type="checkbox"
                                                            id="checkbox<?= $room_service['id'] ?>"
                                                            class="form-check-input"
                                                            name="room_type_services[]"
                                                            value="<?= $room_service['id'] ?>"
                                                            data-parsley-required="true"
                                                        <?php if (!empty($data['room_type_services']) && in_array($room_service['id'], $data['room_type_services'])): ?>
                                                            checked
                                                        <?php endif; ?>
                                                    />
                                                    <label for="checkbox<?= $room_service['id'] ?>"><?= $room_service['name'] ?></label>
                                                </div>
                                            </div>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                                <?php if (!empty($errors['room_type_services'])): ?>
                                    <div class="error text-danger">
                                        <span><?= $errors['room_type_services'][0] ?></span>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="">
                                    Ảnh phòng (Có thể upload nhiều ảnh)
                                </label>
                                <input
                                        type="file"
                                        class="form-control my-pond"
                                        name="photos[]"
                                        multiple
                                />
                                <?php if (!empty($errors['photos'])): ?>
                                    <div class="error text-danger">
                                        <span><?= $errors['photos'][0] ?></span>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="description">
                                    Mô tả
                                </label>
                                <textarea
                                        class="form-control"
                                        name="description"
                                        id="exampleFormControlTextarea1"
                                        placeholder="Mô tả"
                                        rows="3"
                                ><?= $data['description'] ?? false ?></textarea>
                                <?php if (!empty($errors['description'])): ?>
                                    <div class="error text-danger">
                                        <span><?= $errors['description'][0] ?></span>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-12 d-flex justify-content-end">
                            <button
                                    type="submit"
                                    class="btn btn-primary me-1 mb-1"
                                    name="loai_phong_create"
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
<script>
    $(document).ready(function () {
        $(".form").validate({
            rules: {
                "name": {
                    required: true,
                    minlength: 3
                },
                "adult": {
                    required: true,
                    min: 1,
                },
                "size": {
                    required: true,
                    min: 0.1,
                },
                "price": {
                    required: true,
                    min: 0.1,
                },
                "room_type_services[]": {
                    required: true,
                },
                "photos[]": {
                    required: true,
                },
                "description": {
                    required: true,
                }
            },
            messages: {
                name: {
                    required: 'Vui lòng nhập trường này',
                    minlength: 'Không nhập ít hơn 3 ký tự'
                },
                adult: {
                    required: 'Vui lòng nhập trường này',
                    min: 'Tối đa 1 người',
                },
                size: {
                    required: 'Vui lòng nhập trường này',
                    min: 'Không nhập <= 0',
                },
                price: {
                    required: 'Vui lòng nhập trường này',
                    min: 'Không nhập <= 0',
                },
                "room_type_services[]": {
                    required: 'Vui lòng chọn các dịch vụ phòng',
                },
                "photos[]": {
                    required: 'Vui lòng chọn file ảnh',
                },
                description: {
                    required: 'Vui lòng nhập trường này',
                }
            }
        });
    })
</script>
<script src="../public/admin/dist/assets/extensions/parsleyjs/parsley.min.js"></script>
<script src="../public/admin/dist/assets/js/pages/parsley.js"></script>