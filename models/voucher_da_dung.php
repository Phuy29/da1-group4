<?php
function voucher_da_dung_all()
{
    $table = "voucher_used";
    $connect = connect();
    $sql = "
        select
            t.room_type_id,
            t.room_service_id as 'room_service_id',
            room_services.name as 'service_name'
        from {$table} as t
        join room_services on room_services.id = t.room_service_id
    ";
    $result = $connect->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    close_connect($connect);
    return $result;
}

function voucher_da_dung_insert($data = [])
{
    $table = "voucher_used";
    $connect = connect();
    if (!empty($data)) {
        $sql = "
            insert into {$table} (email, code, refresh_time)
            values (:email, :code, :refresh_time)
        ";
        $stmt = $connect->prepare($sql);
        $stmt->execute($data);
        $lastId = $connect->lastInsertId();
        close_connect($connect);
        return $lastId;
    }
}

function voucher_da_dung_find($email, $code, $refresh_time)
{
    $table = "voucher_used";
    $connect = connect();
    $sql = "
            select 
                t.*
            from {$table} as t
            where
                email = :email and
                code = :code and
                refresh_time = :refresh_time
        ";
    $stmt = $connect->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
    $stmt->execute(['email' => $email, 'code' => $code, 'refresh_time' => $refresh_time]);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    close_connect($connect);
    return $result;
}