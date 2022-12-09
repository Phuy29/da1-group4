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

function anh_loai_phong_insert($data = [])
{
    $table = "room_galleries";
    $connect = connect();
    if (!empty($data)) {
        $dataExec = [];
        $sql = "insert into {$table} (image, room_type_id)
            values ";
        foreach ($data as $key => $item) {
            if (is_array($item)) {
                foreach ($item as $value) {
                    $dataExec[] = $value;
                }
            } else {
                $dataExec[] = $item;
            }
            $sql .= '(?, ?),';
        }
        $sql = trim($sql, ' ,');
        $stmt = $connect->prepare($sql);
        $stmt->execute($dataExec);
        $lastId = $connect->lastInsertId();
        close_connect($connect);
        return $lastId;
    }
}

function anh_loai_phong_find_all_by_room_type_id($room_type_id)
{
    $table = "room_galleries";
    $connect = connect();
    if (!empty($room_type_id)) {
        $sql = "
            select * from {$table}
            where room_type_id = :room_type_id
        ";
        $stmt = $connect->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
        $stmt->execute(['room_type_id' => $room_type_id,]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        close_connect($connect);
        return $result;
    }
}

function anh_loai_phong_update($image, $id)
{
    $table = "room_galleries";
    $connect = connect();
    if (!empty($id)) {
        $sql = "
            update {$table}
            set
                image = :image
            where id = :id
        ";
        $stmt = $connect->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
        $stmt->execute(['image' => $image, 'id' => $id,]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        close_connect($connect);
        return $result;
    }
}

function anh_loai_phong_find_by_id($id)
{
    $table = "room_galleries";
    $connect = connect();
    if (!empty($id)) {
        $sql = "
            select * from {$table}
            where id = :id
        ";
        $stmt = $connect->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
        $stmt->execute(['id' => $id,]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        close_connect($connect);
        return $result;
    }
}

function anh_loai_phong_find_first_by_room_type_id($room_type_id)
{
    $table = "room_galleries";
    $connect = connect();
    if (!empty($room_type_id)) {
        $sql = "
            select * from {$table}
            where room_type_id = :room_type_id
            limit 1
        ";
        $stmt = $connect->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
        $stmt->execute(['room_type_id' => $room_type_id,]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        close_connect($connect);
        return $result;
    }
}

function anh_loai_phong_destroy($data)
{
    $table = "room_galleries";
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

function anh_loai_phong_destroy_by_id($id)
{
    $table = "room_galleries";
    $connect = connect();
    if (!empty($id)) {
        $sql = "
            delete from {$table}
            where id = :id
        ";
        $stmt = $connect->prepare($sql);
        $stmt->execute(['id' => $id,]);
        close_connect($connect);
    }
}

function anh_loai_phong_cap_nhat($data)
{
    // var_dump($data);
    // die();
    $table = "room_galleries";
    $connect = connect();
    if (!empty($data)) {
        $sql = "
            update {$table}
            set
                image = :image
            where room_type_id = :room_type_id
        ";
        // die($sql);
        $stmt = $connect->prepare($sql);
        $stmt->execute($data);
        close_connect($connect);
    }
}
