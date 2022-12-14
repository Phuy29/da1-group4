<?php
if (!empty(session_get('status'))) {
    $status = session_get('status');
    session_delete('status');
}
?>

<section class="section">
    <div class="card">
        <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
            <div>Chiến dịch</div>
            <a href="?ctr=<?= $ctr ?? 'home' ?>&act=create" class="btn btn-primary my-3">Thêm chiến dịch</a>
        </div>
        <div class="card-body">
            <table id="table1" class="table w-100">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên chiến dịch</th>
                        <th>Ngày bắt đầu</th>
                        <th>Ngày kết thúc</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($list as $each) : ?>
                        <tr>
                            <td><?= $each['id'] ?></td>
                            <td><?= $each['name'] ?></td>
                            <td><?= get_date_2($each['started_at']) ?></td>
                            <td><?= get_date_2($each['finished_at']) ?></td>
                            <td>
                                <a href="?ctr=<?= $ctr ?? 'home' ?>&act=edit&id=<?= $each['id'] ?>" class="btn icon btn-primary me-2">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <a onclick="confirmDel(`<?= $ctr ?? 'home' ?>`, `<?= $each['id'] ?>`)" class="btn icon btn-danger">
                                    <i class="bi bi-x"></i>
                                </a>
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