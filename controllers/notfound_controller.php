<?php

function show_notfound()
{
    $data = [
        'page_title' => 'File not found',
    ];
    render('404', $data);
}