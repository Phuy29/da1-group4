<?php

// Gán session (SET)
function session_set($key, $val): void
{
    $_SESSION[$key] = $val;
}

// Lấy session (GET)
function session_get($key)
{
    return $_SESSION[$key] ?? false;
}

// Xóa session (DELETE)
function session_delete($key): void
{
    if (isset($_SESSION[$key])) {
        unset($_SESSION[$key]);
    }
}