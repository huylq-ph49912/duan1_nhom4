<?php

// Kết nối CSDL qua PDO
function connectDB() {
    // Kết nối CSDL
    $host = DB_HOST;
    $port = DB_PORT;
    $dbname = DB_NAME;

    try {
        $conn = new PDO("mysql:host=$host;port=$port;dbname=$dbname", DB_USERNAME, DB_PASSWORD);

        // cài đặt chế độ báo lỗi là xử lý ngoại lệ
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // cài đặt chế độ trả dữ liệu
        $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    
        return $conn;
    } catch (PDOException $e) {
        echo ("Connection failed: " . $e->getMessage());
    }
}
    // thêm file
    function uploadFile($file, $foderUpload)
    {
        $pathStorage = $foderUpload . time() . $file['name'];
        $from = $file['tmp_name'];
        $to = PATH_ROOT . $pathStorage;
    if (move_uploaded_file($from, $to)) {
        return $pathStorage;
    }
    return null;
}
// Xóa File
function deleteFile($file)
{
    $pathDelete = PATH_ROOT . $file;
    if (file_exists($pathDelete)) {
        unlink($pathDelete);
    }
}
function deleteSessionError()
{
    if (isset($_SESSION['flash'])) {
        unset($_SESSION['flash']);
        session_unset();
        // session_destroy();
    }
}
function uploadFileAlbum($file, $foderUpload, $key)
{
    $pathStorage = $foderUpload . time() . $file['name'][$key];
    $from = $file['tmp_name'][$key];
    $to = PATH_ROOT . $pathStorage;
    if (move_uploaded_file($from, $to)) {
        return $pathStorage;
    }
    return null;
}
function formatDate($date)
{
    return date("d-m-Y", strtotime($date));
}
function checkLoginAdmin()
{
    if (!isset($_SESSION['user_admin'])) {
        $_SESSION['errors'] = "Bạn cần đăng nhập để tiếp tục!";
        header("Location: " . BASE_URL_ADMIN . '?act=login-admin');
        exit();
    }
}
function formatCurrencyVND($amount) {
    // Sử dụng hàm number_format để format số
    return number_format(num: $amount, decimals: 0, decimal_separator: ',', thousands_separator: '.') . ' VNĐ';
}



