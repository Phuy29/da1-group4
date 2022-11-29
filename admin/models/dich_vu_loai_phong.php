<?php
//function loai_giuong_all()
//{
//    $table = "service_room_type";
//    $connect = connect();
//    $sql = "
//        select * from {$table}
//    ";
//    $result = $connect->query($sql)->fetchAll(PDO::FETCH_ASSOC);
//    close_connect($connect);
//    return $result;
//}

function dich_vu_loai_phong_insert($data = [])
{
    $table = "service_room_type";
    $connect = connect();
    if (!empty($data)) {
        $sql = "
            insert into {$table} (room_service_id, room_type_id)
            values (:room_service_id, :room_type_id)
        ";
        $stmt = $connect->prepare($sql);
        $stmt->execute($data);
        $lastId = $connect->lastInsertId();
        close_connect($connect);
        return $lastId;
    }
}

function dich_vu_loai_phong_destroy_by_room_type_id($data)
{
    $table = "service_room_type";
    $connect = connect();
    if (!empty($data)) {
        $sql = "
            delete from {$table}
            where room_type_id = :room_type_id
        ";
        $stmt = $connect->prepare($sql);
        $stmt->execute($data);
        close_connect($connect);
    }
}

function dich_vu_loai_phong_destroy_by_room_service_id($data)
{
    $table = "service_room_type";
    $connect = connect();
    if (!empty($data)) {
        $sql = "
            delete from {$table}
            where room_service_id = :room_service_id
        ";
        $stmt = $connect->prepare($sql);
        $stmt->execute($data);
        close_connect($connect);
    }
}