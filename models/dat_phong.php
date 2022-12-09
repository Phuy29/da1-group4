<?php
function dat_phong_all()
{
    $table = "booking";
    $connect = connect();
    $sql = "
        select * from {$table}
    ";
    $result = $connect->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    close_connect($connect);
    return $result;
}

function dat_phong_insert($data = [])
{
    $table = "booking";
    $connect = connect();
    if (!empty($data)) {
        $sql = "
            insert into {$table} (fullname, phone_number, email, adults, children, checkin, checkout, discount, total_price)
            values (:fullname, :phone_number, :email, :adults, :children, :checkin, :checkout, :discount, :total_price)
        ";
        $stmt = $connect->prepare($sql);
        $stmt->execute($data);
        $lastId = $connect->lastInsertId();
        close_connect($connect);
        return $lastId;
    }
}

function dat_phong_find_by_id($id)
{
    $table = "booking";
    $connect = connect();
    if (!empty($id)) {
        $sql = "
            select
                t.*,
                bed_types.name as loai_giuong
            from {$table} as t
            join bed_types on bed_types.id = t.bed_type_id
            where t.id = :id
            limit 1
        ";
        $stmt = $connect->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
        $stmt->execute(['id' => $id,]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        close_connect($connect);
        return $result;
    }
}