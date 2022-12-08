<?php
function dich_vu_loai_phong_all()
{
    $table = "service_room_type";
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

function dich_vu_loai_phong_insert($data = [])
{
    $table = "service_room_type";
    $connect = connect();
    if (!empty($data)) {
        $dataExec = [];
        $sql = "insert into {$table} (room_service_id, room_type_id)
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

function dich_vu_loai_phong_destroy_by_room_type_id_and_room_service_id($data)
{
    $table = "service_room_type";
    $connect = connect();
    if (!empty($data)) {
        $sql = "
            delete from {$table}
            where room_type_id = :room_type_id
            and room_service_id = :room_service_id
        ";
        $stmt = $connect->prepare($sql);
        $stmt->execute($data);
        close_connect($connect);
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

function dich_vu_loai_phong_find_all_by_room_type_id($room_type_id)
{
    $table = "service_room_type";
    $connect = connect();
    if (!empty($room_type_id)) {
        $sql = "
            select 
                t.room_service_id as 'room_service_id',
                room_services.name as 'service_name',
                t.room_type_id
            from {$table} as t
            join room_services on room_services.id = t.room_service_id
            where room_type_id = :room_type_id
        ";
        $stmt = $connect->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
        $stmt->execute(['room_type_id' => $room_type_id,]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        close_connect($connect);
        return $result;
    }
}