<?php
// 1. Cấu hình bảo mật (Luôn đặt trên cùng)
ini_set('session.use_only_cookies', 1);
ini_set('session.use_trans_sid', 0);

// 2. Khởi động Session (Chỉ khởi động 1 lần duy nhất ở đây)
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>