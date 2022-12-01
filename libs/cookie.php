<?php

// Gán cookie (SET)
function cookie_set($key, $val, $exprires): void
{
    setcookie($key, $val, $exprires);
}

// Lấy cookie (GET)
function cookie_get($key)
{
    return $_COOKIE[$key] ?? false;
}

// Xóa cookie (DELETE)
function cookie_delete($key): void
{
    if (isset($_COOKIE[$key])) {
        setcookie($key, "", time() - 3600);
    }
}