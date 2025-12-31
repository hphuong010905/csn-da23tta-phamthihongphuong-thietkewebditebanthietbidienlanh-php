<?php
session_start();

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $soluong = 1; // Mặc định mỗi lần bấm là thêm 1

    // Kiểm tra giỏ hàng tồn tại chưa
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    // Cộng dồn số lượng
    if (isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id] += $soluong;
    } else {
        $_SESSION['cart'][$id] = $soluong;
    }

    // Trả về tổng số lượng sản phẩm trong giỏ để JS cập nhật
    echo array_sum($_SESSION['cart']);
}
?>