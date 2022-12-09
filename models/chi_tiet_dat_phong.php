<?php
function chi_tiet_dat_phong_all()
{
    $table = "booking_detail";
    $connect = connect();
    $sql = "
        select 
            t.*,
            booking.checkin,
            booking.checkout,
            booking.status
        from {$table} as t
        join booking on booking.id = t.booking_id
    ";
    $result = $connect->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    close_connect($connect);
    return $result;
}

function chi_tiet_dat_phong_find_by_room_type_id($room_type_id)
{
    $table = "booking_detail";
    $connect = connect();
    if (!empty($room_type_id)) {
        $sql = "
            select 
                t.*,
                booking.checkin,
                booking.checkout,
                booking.status
            from {$table} as t
            join booking on booking.id = t.booking_id
            where t.room_type_id = :room_type_id
        ";
        $stmt = $connect->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
        $stmt->execute(['room_type_id' => $room_type_id,]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        close_connect($connect);
        return $result;
    }
}

function chi_tiet_dat_phong_insert($data = [])
{
    $table = "booking_detail";
    $connect = connect();
    if (!empty($data)) {
        $sql = "
            insert into {$table} (room_type_id, booking_id, price)
            values (:room_type_id, :booking_id, :price)
        ";
//        die($sql);
        $stmt = $connect->prepare($sql);
        $stmt->execute($data);
        $lastId = $connect->lastInsertId();
        close_connect($connect);
        return $lastId;
    }
}

function chi_tiet_dat_phong_find_by_id($id)
{
    $table = "booking_detail";
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