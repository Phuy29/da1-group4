<?php
function voucher_find($id)
{
    $table = "vouchers";
    $connect = connect();
    if (!empty($id)) {
        $sql = "
            select * from {$table}
            where id = :id
            limit 1
        ";
        $stmt = $connect->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
        $stmt->execute(['id' => $id,]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        close_connect($connect);
        return $result;
    }
}

function voucher_find_by_code($code)
{
    $table = "vouchers";
    $connect = connect();
    if (!empty($code)) {
        $sql = "
            select * from {$table}
            where code = :code
            limit 1
        ";
        $stmt = $connect->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
        $stmt->execute(['code' => $code,]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        close_connect($connect);
        return $result;
    }
}

function voucher_cap_nhat_luot_nhap($id)
{
    $table = "vouchers";
    $connect = connect();
    if (!empty($id)) {
        $sql = "
            update {$table}
            set
                used = used + 1
            where id = :id
        ";
        $stmt = $connect->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
        $stmt->execute(['id' => $id,]);
        close_connect($connect);
    }
}