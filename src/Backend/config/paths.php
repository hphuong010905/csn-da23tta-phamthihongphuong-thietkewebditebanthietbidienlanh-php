<?php
// File cấu hình đường dẫn cho dự án
// Tất cả các đường dẫn được định nghĩa từ thư mục gốc dự án

// Đường dẫn gốc của dự án
define('ROOT_PATH', dirname(dirname(dirname(__FILE__))));

// Backend paths
define('BACKEND_PATH', ROOT_PATH . '/Backend');
define('CONFIG_PATH', BACKEND_PATH . '/config');
define('AUTH_PATH', BACKEND_PATH . '/auth');
define('API_PATH', BACKEND_PATH . '/api');
define('CONTROLLERS_PATH', BACKEND_PATH . '/controllers');

// Frontend paths
define('FRONTEND_PATH', ROOT_PATH . '/Frontend');
define('VIEWS_PATH', FRONTEND_PATH . '/views');
define('ASSETS_PATH', FRONTEND_PATH . '/assets');
define('CSS_PATH', ASSETS_PATH . '/css');
define('JS_PATH', ASSETS_PATH . '/js');
define('IMG_PATH', ASSETS_PATH . '/img');
define('LIBS_PATH', ASSETS_PATH . '/libs');

// Database path
define('DATABASE_PATH', ROOT_PATH . '/Database');

// URL paths (relative to web root)
define('BASE_URL', '/CSN');
define('ASSETS_URL', BASE_URL . '/Frontend/assets');
define('CSS_URL', ASSETS_URL . '/css');
define('JS_URL', ASSETS_URL . '/js');
define('IMG_URL', ASSETS_URL . '/img');
define('LIBS_URL', ASSETS_URL . '/libs');
define('VIEWS_URL', BASE_URL . '/Frontend/views');
define('AUTH_URL', BASE_URL . '/Backend/auth');
define('API_URL', BASE_URL . '/Backend/api');
define('CONTROLLERS_URL', BASE_URL . '/Backend/controllers');
?>
