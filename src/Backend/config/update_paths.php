<?php
/**
 * Script để cập nhật đường dẫn trong tất cả các file PHP
 * Chỉ chạy script này MỘT LẦN để cập nhật tất cả các file
 */

echo "========== BẮT ĐẦU CẬP NHẬT ĐƯỜNG DẪN ==========\n\n";

// Các mapping đường dẫn cần thay thế
$pathMappings = [
    // Backend config files
    "require_once 'ConnectDB.php'" => "require_once __DIR__ . '/../../Backend/config/ConnectDB.php'",
    "require_once 'cauhinhSS.php'" => "require_once __DIR__ . '/../../Backend/config/cauhinhSS.php'",
    "require_once 'admin_check.php'" => "require_once __DIR__ . '/../../Backend/auth/admin_check.php'",
    "require 'ConnectDB.php'" => "require __DIR__ . '/../../Backend/config/ConnectDB.php'",
    "require 'cauhinhSS.php'" => "require __DIR__ . '/../../Backend/config/cauhinhSS.php'",
    "include 'ConnectDB.php'" => "include __DIR__ . '/../../Backend/config/ConnectDB.php'",
    "include 'cauhinhSS.php'" => "include __DIR__ . '/../../Backend/config/cauhinhSS.php'",
    
    // Auth links  
    'href="LoginUser.php"' => 'href="../../Backend/auth/LoginUser.php"',
    'href="LoginAD.php"' => 'href="../../Backend/auth/LoginAD.php"',
    'href="RegisterUser.php"' => 'href="../../Backend/auth/RegisterUser.php"',
    'href="RegisterAD.php"' => 'href="../../Backend/auth/RegisterAD.php"',
    'href="LogoutUser.php"' => 'href="../../Backend/auth/LogoutUser.php"',
    
    // Controllers links
    'href="addDM.php"' => 'href="../../Backend/controllers/addDM.php"',
    'href="addSP.php"' => 'href="../../Backend/controllers/addSP.php"',
    'href="changeSP.php' => 'href="../../Backend/controllers/changeSP.php',
    'href="deleteSP.php' => 'href="../../Backend/controllers/deleteSP.php',
    'href="editDM.php' => 'href="../../Backend/controllers/editDM.php',
    
    // API links
    'url:"ajax_cart.php"' => 'url:"../../Backend/api/ajax_cart.php"',
    'url:"search_product.php"' => 'url:"../../Backend/api/search_product.php"',
    'action="xuly_thanhtoan.php"' => 'action="../../Backend/api/xuly_thanhtoan.php"',
];

// Đường dẫn đến thư mục views
$viewsDir = __DIR__ . '/../views';

// Lấy tất cả file PHP trong thư mục views
$files = glob($viewsDir . '/*.php');

$updatedCount = 0;

foreach ($files as $file) {
    $filename = basename($file);
    echo "Đang xử lý: $filename\n";
    
    $content = file_get_contents($file);
    $originalContent = $content;
    
    // Thay thế các đường dẫn
    foreach ($pathMappings as $old => $new) {
        if (strpos($content, $old) !== false) {
            $content = str_replace($old, $new, $content);
            echo "  ✓ Đã thay: $old\n";
        }
    }
    
    // Nếu có thay đổi, ghi lại file
    if ($content !== $originalContent) {
        file_put_contents($file, $content);
        $updatedCount++;
        echo "  → File đã được cập nhật!\n";
    } else {
        echo "  → Không có thay đổi\n";
    }
    
    echo "\n";
}

echo "========== KẾT THÚC ==========\n";
echo "Tổng số file đã cập nhật: $updatedCount/" . count($files) . "\n";
?>
