<?php
if (!empty(session_get('statusSession'))) {
    $statusSession = session_get('statusSession');
    session_delete('statusSession');
}
?>

    <section class="section">
        <div class="">
            <div class="card-header d-flex flex-wrap justify-content-between align-items-center">
                <div>Đơn đặt phòng</div>
            </div>
            <div class="card-body">
                <table id="table1" class="table w-100">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên phòng</th>
                        <th>Email</th>
                        <th>Thời gian</th>
                        <th>Tổng tiền</th>
                        <th>Trạng thái</th>
                        <!--                        <th>Action</th>-->
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($list as $each) : ?>
                        <tr>
                            <td><?= $each['id'] ?></td>
                            <td><?= $each['room_name'] ?></td>
                            <td><?= $each['email'] ?></td>
                            <td><?= get_date_range($each['checkin'], $each['checkout']) ?></td>
                            <td><?= get_price($each['total_price']) ?></td>
                            <td>
                                <form action="?ctr=<?= $ctr ?>&act=set_status" class="d-flex align-items-center"
                                      method="post">
                                    <input type="hidden" name="id" value="<?= $each['id'] ?>">
                                    <select name="status" id="" class="form-select me-1">
                                        <?php foreach (_BOOKING_STATUS as $statusIndex => $statusName) { ?>
                                            <option value="<?= $statusIndex ?>"
                                                <?php if ($statusIndex == $each['status']): ?>
                                                    selected
                                                <?php endif; ?>
                                            >
                                                <?= $statusName ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                    <button class="btn btn-icon btn-primary me-1" style="width: fit-content;"
                                            name="set_status_btn">
                                        Update
                                    </button>
                                    <a href="?ctr=<?= $ctr ?>&act=detail&id=<?= $each['id'] ?>"
                                       class="btn icon btn-info">
                                        Xem
                                    </a>
                                </form>
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
<?php if (!empty($statusSession)) : ?>
    <script>
        window.onload = () => {
            Swal.fire({
                icon: `<?= $statusSession['type'] ?>`,
                title: `<?= $statusSession['title'] ?>`,
            })
        }
    </script>
<?php endif; ?>