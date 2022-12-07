<?php
if (!empty(session_get('status'))) {
    $status = session_get('status');
    session_delete('status');
}
?>

    <section class="section">
        <div class="">
            <div class="card-header d-flex flex-wrap justify-content-between align-items-center">
                <div>Quản lý</div>
                <a href="?ctr=<?= $ctr ?? 'home' ?>" class="btn btn-primary my-3">Danh sách người dùng</a>
            </div>
            <div class="card-body">
                <table id="table1" class="table w-100">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Họ tên</th>
                        <th>Email</th>
                        <th>Số điện thoại</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($list as $each) : ?>
                        <tr>
                            <td><?= $each['id'] ?></td>
                            <td><?= $each['fullname'] ?></td>
                            <td><?= $each['email'] ?></td>
                            <td><?= $each['phone_number'] ?></td>
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