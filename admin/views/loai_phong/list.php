<?php
if (!empty(session_get('status'))) {
    $status = session_get('status');
    session_delete('status');
}
?>

<section class="section">
    <div class="">
        <div class="card-header d-flex flex-wrap justify-content-between align-items-center">
            <div>Dịch vụ phòng</div>
            <a href="?ctr=<?= $ctr ?? 'home' ?>&act=create" class="btn btn-primary my-3">Thêm loại phòng</a>
        </div>
        <div class="card-body">
            <table id="table1" class="table w-100">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên phòng</th>
                        <th>Số người lớn</th>
                        <th>Diện tích</th>
                        <th>Giá</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($list as $each) : ?>
                        <tr>
                            <td><?= $each['id'] ?></td>
                            <td><?= $each['name'] ?></td>
                            <td><?= $each['adults'] ?></td>
                            <td><?= $each['size'] ?> m2</td>
                            <td><?= get_price($each['price']) ?></td>
                            <td>
                                <a href="?ctr=<?= $ctr ?? 'home' ?>&act=edit&id=<?= $each['id'] ?>" class="btn icon btn-primary me-2">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <!-- Button trigger for basic modal -->

                                <a data-bs-toggle="modal" data-bs-target="#xoa_loai_phong_<?= $each['id'] ?>" class="btn icon btn-danger">
                                    <i class="bi bi-x"></i>
                                </a>

                                <!--Basic Modal -->
                                <div class="modal fade text-left" id="xoa_loai_phong_<?= $each['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel120" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header bg-danger">
                                                <h5 class="modal-title white" id="myModalLabel120">Delete room type
                                                </h5>
                                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                    <i data-feather="x"></i>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Bạn có chắc muốn xóa <span style="font-weight: 800;"><?= $each['name'] ?></span> không?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                                    <i class="bx bx-x d-block d-sm-none"></i>
                                                    <span class="d-none d-sm-block">Close</span>
                                                </button>
                                                <button type="button" class="btn btn-danger ml-1" data-bs-dismiss="modal">
                                                    <i class="bx bx-check d-block d-sm-none"></i>
                                                    <span class="d-none d-sm-block">
                                                        <a href="?ctr=<?= $ctr ?? 'home' ?>&act=delete&id=<?= $each['id'] ?>" style="color: white;">
                                                            Accept
                                                        </a>
                                                    </span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</section>
<script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
<script src="../public/admin/dist/assets/js/pages/datatables.js"></script>
<script src="../public/admin/dist/assets/extensions/sweetalert2/sweetalert2.min.js"></script>
<?php if (!empty($status)) : ?>
    <script>
        window.onload = () => {
            Swal.fire({
                icon: "<?= $status['type'] ?>",
                title: "<?= $status['title'] ?>",
            })
        }
    </script>
<?php endif; ?>