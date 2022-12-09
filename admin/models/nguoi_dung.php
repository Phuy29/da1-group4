<?php
function nguoi_dung_all()
{
    $table = "users";
    $connect = connect();
    $sql = "
        select 
            *
        from {$table}
        where role <= 1
    ";
    $result = $connect->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    close_connect($connect);
    return $result;
}

function quan_ly_all()
{
    $table = "users";
    $connect = connect();
    $sql = "
        select 
            *
        from {$table}
        where role = 2
    ";
    $result = $connect->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    close_connect($connect);
    return $result;
}

function nguoi_dung_find($id)
{
    $table = "users";
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

function nguoi_dung_find_by_name($name)
{
    $table = "users";
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

function nguoi_dung_cap_nhat_quyen($role, $id)
{
    $table = "users";
    $connect = connect();
    if (!empty($id)) {
        $sql = "
            update {$table}
            set
                role = :role
            where id = :id
        ";
        $stmt = $connect->prepare($sql);
        $stmt->execute(['id' => $id, 'role' => $role]);
        close_connect($connect);
    }
}