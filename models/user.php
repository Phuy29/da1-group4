<?php
function nguoi_dung_all()
{
    $table = "users";
    $connect = connect();
    $sql = "
        select 
            id,
            fullname,
            email,
            phone_number,
            role
        from {$table}
    ";
    $result = $connect->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    close_connect($connect);
    return $result;
}

function nguoi_dung_insert($data = [])
{
    $table = "users";
    $connect = connect();
    if (!empty($data)) {
        $sql = "
            insert into {$table} (fullname, phone_number, email, password)
            values (:fullname, :phone_number, :email, :password)
        ";
        $stmt = $connect->prepare($sql);
        $stmt->execute($data);
        $lastId = $connect->lastInsertId();
        close_connect($connect);
        return $lastId;
    }
}

function nguoi_dung_find_by_id($id)
{
    $table = "users";
    $connect = connect();
    if (!empty($id)) {
        $sql = "
            select 
                id,
                fullname,
                email,
                phone_number,
                role
            from {$table}
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

function nguoi_dung_find_by_email($email)
{
    $table = "users";
    $connect = connect();
    if (!empty($email)) {
        $sql = "
            select 
                id,
                fullname,
                email,
                phone_number,
                role
            from {$table}
            where email = :email
            limit 1
        ";
        $stmt = $connect->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
        $stmt->execute(['email' => $email,]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        close_connect($connect);
        return $result;
    }
}

function nguoi_dung_find_to_login($email, $password)
{
    $table = "users";
    $connect = connect();
    if (!empty($email)) {
        $sql = "
            select 
                id,
                fullname,
                email,
                phone_number,
                role
            from {$table}
            where
                email = :email
                and password = :password
            limit 1
        ";
        $stmt = $connect->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
        $stmt->execute(['email' => $email, 'password' => $password,]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        close_connect($connect);
        return $result;
    }
}

function nguoi_dung_cap_nhat($data)
{
    $table = "users";
    $connect = connect();
    if (!empty($data)) {
        $sql = "
            update {$table}
            set
                fullname = :fullname,
                phone_number = :phone_number
            where id = :id
        ";
        $stmt = $connect->prepare($sql);
        $stmt->execute($data);
        close_connect($connect);
    }
}

function nguoi_dung_doi_mat_khau($password, $id)
{
    $table = "users";
    $connect = connect();
    $sql = "
            update {$table}
            set
                password = :password
            where id = :id
        ";
    $stmt = $connect->prepare($sql);
    $stmt->execute(['id' => $id, 'password' => $password]);
    close_connect($connect);
}

function nguoi_dung_destroy($data)
{
    $table = "users";
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