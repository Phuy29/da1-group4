<?php
if (!empty(session_get('status'))) {
    $status = session_get('status');
    session_delete('status');
}
if (!empty(session_get('user_session'))) {
    $user_session = session_get('user_session');
}
?>

    <section class="section">
        <div class="">
            <div class="card-header d-flex flex-wrap justify-content-between align-items-center">
                <div>Người dùng</div>
                <?php if ($user_session['role'] == 2): ?>
                    <a href="?ctr=<?= $ctr ?? 'home' ?>&act=list_quan_ly" class="btn btn-primary my-3">Danh sách quản
                        lý</a>
                <?php endif; ?>
            </div>
            <div class="card-body">
                <table id="table1" class="table w-100">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Họ tên</th>
                        <th>Email</th>
                        <th>Vai trò</th>
                        <?php if ($user_session['role'] == 2): ?>
                            <th>Action</th>
                        <?php endif; ?>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($list as $each) : ?>
                        <tr>
                            <td><?= $each['id'] ?></td>
                            <td><?= $each['fullname'] ?></td>
                            <td><?= $each['email'] ?></td>
                            <td><?= get_role($each['role']) ?></td>
                            <?php if ($user_session['role'] == 2): ?>
                                <td>
                                    <?php if ($each['role'] == 0): ?>
                                        <a id="admin_action_btn"
                                           href="?ctr=<?= $ctr ?? 'home' ?>&act=set_admin&id=<?= $each['id'] ?>"
                                           class="btn icon btn-primary me-2">
                                            Đặt làm nhân viên
                                        </a>
                                    <?php else: ?>
                                        <a id="admin_action_btn"
                                           href="?ctr=<?= $ctr ?? 'home' ?>&act=unset_admin&id=<?= $each['id'] ?>"
                                           class="btn icon btn-danger me-2">
                                            Bỏ quyền nhân viên
                                        </a>
                                    <?php endif; ?>
                                </td>
                            <?php endif; ?>
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