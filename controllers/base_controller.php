<?php

// Hàm hiển thị kết quả ra cho người dùng.
function render($path, $data = [], $isAdminSite = false)
{

    $view_folder = $isAdminSite ? '../views/' : 'views/';
    $layout_folder = $isAdminSite ? '/admin/' : '/client/';

    $path = str_replace('.', '/', $path);

    // Kiểm tra file gọi đến có tồn tại hay không?
    $view_file = $view_folder . $path . '.php';
    if (is_file($view_file)) {
        // Nếu tồn tại file đó thì tạo ra các biến chứa giá trị truyền vào lúc gọi hàm
        extract($data);
        // Sau đó lưu giá trị trả về khi chạy file view template với các dữ liệu đó vào 1 biến chứ chưa hiển thị luôn ra trình duyệt
        ob_start();
        require_once($view_file);
        $content = ob_get_clean();

        // Sau khi có kết quả đã được lưu vào biến $content, gọi ra template chung của hệ thống đế hiển thị ra cho người dùng
        $layout_file = $view_folder . 'layouts' . $layout_folder . 'master.php';
        require_once($layout_file);
    } else {
        // Nếu file muốn gọi ra không tồn tại thì chuyển hướng đến trang báo lỗi.
        header('location: master.php?ctr=404');
    }
}