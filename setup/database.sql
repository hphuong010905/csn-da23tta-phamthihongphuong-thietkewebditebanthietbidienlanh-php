-- =============================================
-- HƯỚNG DẪN CÀI ĐẶT DATABASE
-- =============================================
-- 1. Tạo database mới tên "databasecsn"
-- 2. Import file này vào database
-- 3. Cập nhật thông tin kết nối trong src/Backend/config/ConnectDB.php
-- =============================================

CREATE DATABASE IF NOT EXISTS `databasecsn` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `databasecsn`;

-- =============================================
-- Tạo các bảng cơ sở dữ liệu
-- =============================================
-- Lưu ý: Thêm cấu trúc bảng thực tế của bạn vào đây
-- Ví dụ:

-- Bảng danh mục
CREATE TABLE IF NOT EXISTS `danhmuc` (
  `dm_id` int(11) NOT NULL AUTO_INCREMENT,
  `dm_ten` varchar(255) NOT NULL,
  `dm_mota` text,
  PRIMARY KEY (`dm_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Bảng sản phẩm
CREATE TABLE IF NOT EXISTS `sanpham` (
  `sp_id` int(11) NOT NULL AUTO_INCREMENT,
  `sp_ten` varchar(255) NOT NULL,
  `sp_gia` decimal(10,2) NOT NULL,
  `sp_mota` text,
  `sp_hinhanh` varchar(255),
  `dm_id` int(11),
  PRIMARY KEY (`sp_id`),
  FOREIGN KEY (`dm_id`) REFERENCES `danhmuc`(`dm_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Bảng khách hàng
CREATE TABLE IF NOT EXISTS `khachhang` (
  `kh_id` int(11) NOT NULL AUTO_INCREMENT,
  `kh_ten` varchar(255) NOT NULL,
  `kh_email` varchar(255) NOT NULL,
  `kh_matkhau` varchar(255) NOT NULL,
  `kh_sdt` varchar(20),
  `kh_diachi` text,
  PRIMARY KEY (`kh_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Bảng admin
CREATE TABLE IF NOT EXISTS `admin` (
  `admin_id` varchar(50) NOT NULL,
  `admin_password` varchar(255) NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Bảng đơn hàng
CREATE TABLE IF NOT EXISTS `donhang` (
  `dh_id` int(11) NOT NULL AUTO_INCREMENT,
  `kh_id` int(11) NOT NULL,
  `dh_ngaydat` datetime DEFAULT CURRENT_TIMESTAMP,
  `dh_tongtien` decimal(10,2) NOT NULL,
  `dh_trangthai` varchar(50) DEFAULT 'Đang xử lý',
  PRIMARY KEY (`dh_id`),
  FOREIGN KEY (`kh_id`) REFERENCES `khachhang`(`kh_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Bảng chi tiết đơn hàng
CREATE TABLE IF NOT EXISTS `chitietdonhang` (
  `ctdh_id` int(11) NOT NULL AUTO_INCREMENT,
  `dh_id` int(11) NOT NULL,
  `sp_id` int(11) NOT NULL,
  `ctdh_soluong` int(11) NOT NULL,
  `ctdh_gia` decimal(10,2) NOT NULL,
  PRIMARY KEY (`ctdh_id`),
  FOREIGN KEY (`dh_id`) REFERENCES `donhang`(`dh_id`),
  FOREIGN KEY (`sp_id`) REFERENCES `sanpham`(`sp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- =============================================
-- Dữ liệu mẫu
-- =============================================
-- Insert admin mặc định (password: admin123)
INSERT INTO `admin` (`admin_id`, `admin_password`) VALUES
('admin', '$2y$10$abcdefghijklmnopqrstuv'); -- Thay bằng mật khẩu đã hash

-- =============================================
-- Hoàn tất
-- =============================================
