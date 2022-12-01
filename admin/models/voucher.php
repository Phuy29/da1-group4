<?php
function voucher_all()
{
    $table = "vouchers";
    $connect = connect();
    $sql = "
        select
            t.*,
            campaigns.name as 'campaign_name'
        from {$table} as t
        join campaigns on campaigns.id = t.campaign_id
    ";
    $result = $connect->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    close_connect($connect);
    return $result;
}

function voucher_insert($data = [])
{
    $table = "vouchers";
    $connect = connect();
    if (!empty($data)) {
        $sql = "
            insert into {$table} (code, discount, campaign_id, status)
            values (:code, :discount, :campaign_id, :status)
        ";
        $stmt = $connect->prepare($sql);
        $stmt->execute($data);
        $lastId = $connect->lastInsertId();
        close_connect($connect);
        return $lastId;
    }
}

function voucher_find($id)
{
    $table = "vouchers";
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

function voucher_cap_nhat($data)
{
    $table = "vouchers";
    $connect = connect();
    if (!empty($data)) {
        $sql = "
            update {$table}
            set
                discount = :discount,
                status = :status,
                campaign_id = :campaign_id
            where id = :id
        ";
        $stmt = $connect->prepare($sql);
        $stmt->execute($data);
        close_connect($connect);
    }
}

function voucher_destroy($data)
{
    $table = "vouchers";
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