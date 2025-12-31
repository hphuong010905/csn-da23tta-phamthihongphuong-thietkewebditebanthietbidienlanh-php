# HƯỚNG DẪN CÀI ĐẶT HỆ THỐNG

## Yêu cầu hệ thống

### Phần mềm cần thiết:
- **XAMPP** hoặc **Laragon** (khuyến nghị Laragon)
- PHP version: >= 7.4
- MySQL/MariaDB: >= 5.7
- Web Browser: Chrome, Firefox, Edge (phiên bản mới nhất)

### Thông số kỹ thuật tối thiểu:
- RAM: 4GB trở lên
- Dung lượng ổ cứng: 500MB trống
- Hệ điều hành: Windows 10/11, Linux, MacOS

---

## Các bước cài đặt

### Bước 1: Cài đặt Laragon/XAMPP

1. **Tải Laragon** từ: https://laragon.org/download/
   - Hoặc **XAMPP** từ: https://www.apachefriends.org/

2. Cài đặt theo hướng dẫn mặc định

3. Khởi động Apache và MySQL

### Bước 2: Clone/Copy source code

```bash
# Clone từ GitHub
git clone https://github.com/hphuong010905/csn-da23tta-thietkewebditebanthietbidienlanh-php.git

# Hoặc copy thư mục src vào thư mục www của Laragon
# Đường dẫn mặc định: C:\laragon\www\CSN
```

### Bước 3: Cấu hình Database

1. Mở **phpMyAdmin**: http://localhost/phpmyadmin

2. Tạo database mới:
   - Tên database: `databasecsn`
   - Collation: `utf8mb4_unicode_ci`

3. Import file database:
   - Vào tab **Import**
   - Chọn file: `setup/database.sql`
   - Click **Go** để import

### Bước 4: Cấu hình kết nối Database

Mở file `src/Backend/config/ConnectDB.php` và cập nhật thông tin:

```php
<?php
$servername = "localhost";
$username = "root";        // Thay đổi nếu cần
$password = "";            // Thay đổi nếu cần
$dbname = "databasecsn";
```

### Bước 5: Cấu hình Virtual Host (Tùy chọn - khuyến nghị)

#### Với Laragon:
1. Click chuột phải vào icon Laragon
2. Chọn **Apache** > **sites-enabled** > **Add site**
3. Nhập tên: `csn.test`
4. Restart Apache

#### Với XAMPP:
Cấu hình file `httpd-vhosts.conf` và `hosts`

### Bước 6: Chạy ứng dụng

Mở trình duyệt và truy cập:

```
http://localhost/CSN/src/Frontend/views/index.php

# Hoặc với Virtual Host:
http://csn.test/src/Frontend/views/index.php
```

---

## Tài khoản mặc định

### Admin:
- **Tài khoản**: admin
- **Mật khẩu**: admin123

### Khách hàng:
- Đăng ký tài khoản mới tại trang chủ

---

## Cấu trúc thư mục

```
src/
├── Backend/
│   ├── config/      # Cấu hình hệ thống
│   ├── auth/        # Xác thực người dùng
│   ├── api/         # API endpoints
│   └── controllers/ # Controllers
│
├── Frontend/
│   ├── views/       # Giao diện người dùng
│   └── assets/      # CSS, JS, Images, Libraries
│
└── Database/        # Scripts database
```

---

## Xử lý sự cố

### Lỗi kết nối database:
- Kiểm tra MySQL đã chạy chưa
- Xác nhận thông tin trong `ConnectDB.php`
- Kiểm tra tên database đã tạo

### Lỗi 404 Not Found:
- Kiểm tra đường dẫn file
- Kiểm tra Virtual Host
- Xóa cache browser

### Lỗi hiển thị tiếng Việt:
- Kiểm tra charset database: `utf8mb4`
- Kiểm tra charset trong file PHP

---

## Hỗ trợ

Nếu gặp vấn đề, vui lòng liên hệ:
- **Email**: hphuong010905@student.ctu.edu.vn
- **GitHub Issues**: https://github.com/hphuong010905/csn-da23tta-thietkewebditebanthietbidienlanh-php/issues

---

**Lưu ý**: Đây là phiên bản demo cho mục đích học tập. Không sử dụng trong môi trường production mà không có bảo mật bổ sung.
