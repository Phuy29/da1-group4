<?php
if (!empty(session_get('user_session'))) {
    $user_session = session_get('user_session');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $page_title ?? 'Dashboard' ?></title>

    <link rel="stylesheet" href="../public/admin/dist/assets/css/main/app.css">
    <link rel="stylesheet" href="../public/admin/dist/assets/css/main/app-dark.css">
    <link rel="shortcut icon" href="../public/admin/dist/assets/images/logo/favicon.svg" type="image/x-icon">
    <link rel="shortcut icon" href="../public/admin/dist/assets/images/logo/favicon.png" type="image/png">

    <link rel="stylesheet" href="../public/admin/dist/assets/css/shared/iconly.css">
    <!--    <link rel="stylesheet" href="../public/admin/dist/assets/extensions/filepond/filepond.css"/>-->
    <link
            rel="stylesheet"
            href="../public/admin/dist/assets/extensions/filepond-plugin-image-preview/filepond-plugin-image-preview.css"
    />
    <link
            rel="stylesheet"
            href="../public/admin/dist/assets/extensions/toastify-js/src/toastify.css"
    />
    <!--    <link rel="stylesheet" href="../public/admin/dist/assets/css/pages/filepond.css"/>-->
    <link rel="stylesheet" href="../public/admin/dist/assets/css/pages/fontawesome.css"/>
    <link
            rel="stylesheet"
            href="../public/admin/dist/assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css"
    />
    <link rel="stylesheet" href="../public/admin/dist/assets/css/pages/datatables.css"/>
    <link
            rel="stylesheet"
            href="../public/admin/dist/assets/extensions/sweetalert2/sweetalert2.min.css"
    />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/additional-methods.min.js"></script>
    <style>
        label.error {
            color: rgb(220 53 69) !important;
        }
    </style>
</head>

<body>
<div id="app">