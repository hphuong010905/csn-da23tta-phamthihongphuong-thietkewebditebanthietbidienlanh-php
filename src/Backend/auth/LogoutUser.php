<?php
require_once 'cauhinhSS.php';
require_once 'ConnectDB.php';
?>
<?php
session_start();
session_destroy(); // Xóa sạch session
header("Location: index.php"); // Quay về trang chủ
exit();
?>