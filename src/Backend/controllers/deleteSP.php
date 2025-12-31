<?php
require_once 'cauhinhSS.php';
require_once 'ConnectDB.php';
require_once 'admin_check.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Lệnh xóa sản phẩm dựa vào MASP
    $sql = "DELETE FROM SAN_PHAM WHERE MASP = '$id'";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
                alert('Đã xóa sản phẩm thành công!');
                window.location.href = 'QLSP.php';
              </script>";
    } else {
        echo "Lỗi xóa: " . $conn->error;
    }
} else {
    // Nếu không có ID thì đá về trang chủ admin
    header("Location: QLSP.php");
}
?>