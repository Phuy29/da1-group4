<?php
function loai_phong_all()
{
    $table = "room_types";
    $connect = connect();
    $sql = "
        select
            t.*,
            bed_types.name as loai_giuong
        from {$table} as t
        join bed_types on bed_types.id = t.bed_type_id
    ";
    $result = $connect->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    close_connect($connect);
    return $result;
}

function loai_phong_find_by_id($id)
{
    $table = "room_types";
    $connect = connect();
    if (!empty($id)) {
        $sql = "
            select
                t.*,
                bed_types.name as loai_giuong
            from {$table} as t
            join bed_types on bed_types.id = t.bed_type_id
            where t.id = :id
            limit 1
        ";
        $stmt = $connect->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
        $stmt->execute(['id' => $id,]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        close_connect($connect);
        return $result;
    }
}