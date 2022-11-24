<?php
function dich_vu_phong_all()
{
    $table = "room_services";
    $connect = connect();
    $sql = "
        select * from {$table}
    ";
    $result = $connect->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    close_connect($connect);
    return $result;
}

function dich_vu_phong_insert($data = [])
{
    $table = "room_services";
    $connect = connect();
    if (!empty($data)) {
        $sql = "
            insert into {$table} (name)
            values (:name)
        ";
        $stmt = $connect->prepare($sql);
        $stmt->execute($data);
        $lastId = $connect->lastInsertId();
        close_connect($connect);
        return $lastId;
    }
}

function dich_vu_phong_find($id)
{
    $table = "room_services";
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

function dich_vu_phong_cap_nhat($data)
{
    $table = "room_services";
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

function dich_vu_phong_destroy($data)
{
    $table = "room_services";
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