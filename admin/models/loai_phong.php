<?php
function loai_phong_all()
{
    $table = "room_types";
    $connect = connect();
    $sql = "
        select * from {$table}
    ";
    $result = $connect->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    close_connect($connect);
    return $result;
}

function loai_phong_insert($data = [])
{
    $table = "room_types";
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

function loai_phong_find($id)
{
    $table = "room_types";
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

function loai_phong_find_by_name($name) {
    $table = "room_types";
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

function loai_phong_cap_nhat($data)
{
    $table = "room_types";
    $connect = connect();
    if (!empty($data)) {
        $sql = "
            update {$table}
            set
                name = :name
            where id = :id
        ";
        $stmt = $connect->prepare($sql);
        $stmt->execute($data);
        close_connect($connect);
    }
}

function loai_phong_destroy($data)
{
    $table = "room_types";
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