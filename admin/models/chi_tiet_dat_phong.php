<?php
function chi_tiet_dat_phong_all()
{
    $table = "booking_detail";
    $connect = connect();
    $sql = "
        select 
            room_types.name as room_name,
            room_types.id as room_id,
            room_types.price,
            booking.*
        from {$table} as t
        join booking on booking.id = t.booking_id
        join room_types on room_types.id = t.room_type_id
        order by booking.id desc
    ";
    $result = $connect->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    close_connect($connect);
    return $result;
}

function chi_tiet_dat_phong_insert($data = [])
{
    $table = "booking_detail";
    $connect = connect();
    if (!empty($data)) {
        $sql = "
            insert into {$table} (name, adults, size, bed_type_id, price, description)
            values (:name, :adults, :size, :bed_type_id, :price, :description)
        ";
//        die($sql);
        $stmt = $connect->prepare($sql);
        $stmt->execute($data);
        $lastId = $connect->lastInsertId();
        close_connect($connect);
        return $lastId;
    }
}

function chi_tiet_dat_phong_find_by_booking_id($booking_id)
{
    $table = "booking_detail";
    $connect = connect();
    $sql = "
        select 
            room_types.name as room_name,
            room_types.price,
            booking.*
        from {$table} as t
        join booking on booking.id = t.booking_id
        join room_types on room_types.id = t.room_type_id
        where booking_id = :booking_id
        order by booking.id desc
    ";
    $stmt = $connect->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
    $stmt->execute(['booking_id' => $booking_id,]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    close_connect($connect);
    return $result;
}

function chi_tiet_dat_phong_find_by_name($name)
{
    $table = "booking_detail";
    $connect = connect();
    if (!empty($name)) {
        $sql = "
            select * from {$table}
            where name like :name
            limit 1
        ";
        $stmt = $connect->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
        $stmt->execute(['name' => $name,]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        close_connect($connect);
        return $result;
    }
}

function chi_tiet_dat_phong_cap_nhat($data)
{
    // var_dump($data);
    // die();
    $table = "booking_detail";
    $connect = connect();
    if (!empty($data)) {
        $sql = "
            update {$table}
            set
                name = :name,
                adults = :adults,
                size = :size,
                bed_type_id = :bed_type_id,
                description = :description,
                price = :price
            where id = :id
        ";
        $stmt = $connect->prepare($sql);
        $stmt->execute($data);
        close_connect($connect);
    }
}

function chi_tiet_dat_phong_destroy($data)
{
    $table = "booking_detail";
    $connect = connect();
    if (!empty($data)) {
        $sql = "
            delete from {$table}
            where id = :id
        ";
        $stmt = $connect->prepare($sql);
        $stmt->execute($data);
        close_connect($connect);
    }
}
