<?php

function show_notfound($isAdminSite = false)
{
    $data = [
        'page_title' => 'File not found',
    ];
    render('404', $data, $isAdminSite);
}