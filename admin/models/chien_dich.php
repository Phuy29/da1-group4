<?php
function chien_dich_all()
{
    $table = "campaigns";
    $connect = connect();
    $sql = "
        select * from {$table}
    ";
    $result = $connect->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    close_connect($connect);
    return $result;
}

function chien_dich_insert($data = [])
{
    $table = "campaigns";
    $connect = connect();
    if (!empty($data)) {
        $sql = "
            insert into {$table} (name, started_at, finished_at)
            values (:name, :started_at, :finished_at)
        ";
        $stmt = $connect->prepare($sql);
        $stmt->execute($data);
        $lastId = $connect->lastInsertId();
        close_connect($connect);
        return $lastId;
    }
}

function chien_dich_find($id)
{
    $table = "campaigns";
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

function chien_dich_cap_nhat($data)
{
    $table = "campaigns";
    $connect = connect();
    if (!empty($data)) {
        $sql = "
            update {$table}
            set
                name = :name,
                started_at = :started_at,
                finished_at = :finished_at
            where id = :id

        ";
        $stmt = $connect->prepare($sql);
        $stmt->execute($data);
        close_connect($connect);
    }
}

function chien_dich_destroy($data)
{
    $table = "campaigns";
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