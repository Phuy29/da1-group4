<?php
function get_date($time)
{
    return date("H:i d/m/Y", strtotime($time));
}

function redirect($data)
{
    if (!empty($data)) {
        $ctr = $data['ctr'] ?? 'dashboard';
        $act = $data['act'] ?? 'index';
        $path = "?ctr={$ctr}&act={$act}";
        if (!empty($data['id'])) {
            $path .= "&id={$data['id']}";
        }
        header("location: $path");
    }
}