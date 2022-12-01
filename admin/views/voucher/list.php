<?php
if (!empty(session_get('status'))) {
    $status = session_get('status');
    session_delete('status');
}
?>

    <section class="section">
        <div class="">
            <div class="card-header d-flex flex-wrap justify-content-between align-items-center">
                <div>Voucher</div>
                <a href="?ctr=<?= $ctr ?? 'home' ?>&act=create" class="btn btn-primary my-3">Tạo voucher</a>
            </div>
            <div class="card-body">
                <table id="table1" class="table w-100">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Voucher</th>
                        <th>Loại</th>
                        <th>Giảm giá (%)</th>
                        <th>Tên chiến dịch</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($list as $each) :
                        $link = false;
                        if ($each['status'] !== 0) {
                            if ($each['status'] == 1) {
                                $act = 'send_all';
                            } else {
                                $act = 'send_one&id=' . $each['id'];
                            }
                            $link = '?ctr=' . $ctr . '&act=' . $act;
                        }
                        ?>
                        <tr>
                            <td><?= $each['id'] ?></td>
                            <td><?= $each['code'] ?></td>
                            <td><?= get_voucher_status($each['status']) ?></td>
                            <td><?= $each['discount'] ?></td>
                            <td><?= $each['campaign_name'] ?></td>
                            <td>
                                <a href="?ctr=<?= $ctr ?? 'home' ?>&act=edit&id=<?= $each['id'] ?>"
                                   class="btn icon btn-primary me-2">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <a onclick="confirmDel(`<?= $ctr ?? 'home' ?>`, `<?= $each['id'] ?>`)"
                                   class="btn icon btn-danger me-2">
                                    <i class="bi bi-x"></i>
                                </a>
                                <?php if (!empty($link)): ?>
                                    <a href="<?= $link ?>"
                                       class="btn icon btn-info me-2">
                                        <i class="bi bi-send"></i>
                                    </a>
                                <?php endif; ?>
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