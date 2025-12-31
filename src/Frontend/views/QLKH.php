<?php
// 1. Cấu hình & Bảo mật
require_once 'cauhinhSS.php';
require_once 'admin_check.php'; 
require_once 'ConnectDB.php';

// ---------------------------------------------------------
// LOGIC 1: XỬ LÝ XÓA KHÁCH HÀNG (Ngay tại file này)
// ---------------------------------------------------------
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Kiểm tra xem khách hàng có đơn hàng chưa (Tránh lỗi ràng buộc khóa ngoại)
    // Nếu chưa có bảng DON_HANG thì bỏ qua đoạn kiểm tra này
    /*
    $check_order = $conn->query("SELECT * FROM DON_HANG WHERE MAKH = '$id'");
    if ($check_order->num_rows > 0) {
        echo "<script>alert('Không thể xóa! Khách hàng này đã có đơn hàng.'); window.location.href='QLKH.php';</script>";
        exit();
    }
    */

    $sql = "DELETE FROM KHACH_HANG WHERE MAKH = '$id'";
    
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Đã xóa khách hàng thành công!'); window.location.href='QLKH.php';</script>";
    } else {
        echo "<script>alert('Lỗi khi xóa: " . $conn->error . "'); window.location.href='QLKH.php';</script>";
    }
    exit();
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản Lý Khách Hàng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        @media print {
            /* Ẩn các thành phần không cần thiết khi in */
            .no-print, .navbar, footer, .btn {
                display: none !important;
            }
            /* Căn chỉnh bảng khi in */
            .card, .container {
                border: none !important;
                box-shadow: none !important;
                width: 100% !important;
                max-width: 100% !important;
                padding: 0 !important;
                margin: 0 !important;
            }
            /* Đảm bảo in ra khổ A4 đẹp */
            @page { margin: 20px; }
            body { background: white !important; }
        }
    </style>
</head>
<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-5 shadow">
    <div class="container">
        
        <a href="QTHT.php" class="btn btn-outline-light btn-sm fw-bold shadow-sm me-3" title="Về trang chủ">
            <i class="fa-solid fa-house"></i>
        </a>

        <span class="navbar-brand mb-0 h1 fw-bold text-uppercase">
            <i class="fa-solid fa-gauge-high me-2"></i>Quản lý khách hàng
        </span>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <div class="ms-auto d-flex text-white align-items-center mt-2 mt-lg-0">
                <span class="me-3">Xin chào, <b class="text-warning"><?php echo $_SESSION['admin_id']; ?></b></span>
                <a href="LoginAD.php" class="btn btn-sm btn-light text-danger fw-bold shadow-sm">
                    <i class="fa-solid fa-right-from-bracket"></i> Đăng xuất
                </a>
            </div>
        </div>

    </div>
</nav>

    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="text-success fw-bold border-start border-4 border-success ps-3">QUẢN LÝ KHÁCH HÀNG</h2>
            
            <button onclick="window.print()" class="btn btn-outline-success fw-bold no-print">
                <i class="fa-solid fa-print me-2"></i> In Danh Sách
            </button>
        </div>

        <div class="card shadow border-0 rounded-3">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-success text-white">
                            <tr>
                                <th class="py-3 ps-3">Mã KH</th>
                                <th class="py-3">Họ Tên</th>
                                <th class="py-3">Thông Tin Liên Hệ</th>
                                <th class="py-3">Địa Chỉ</th>
                                <th class="py-3 text-center no-print">Thao Tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT * FROM KHACH_HANG ORDER BY MAKH DESC";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                            ?>
                                <tr>
                                    <td class="ps-3 fw-bold text-success"><?php echo $row['MAKH']; ?></td>
                                    
                                    <td>
                                        <div class="fw-bold text-dark"><?php echo $row['TENKH']; ?></div>
                                    </td>

                                    <td>
                                        <div><i class="fa-solid fa-envelope text-muted me-2"></i><?php echo $row['EMAIL']; ?></div>
                                        <div class="mt-1"><i class="fa-solid fa-phone text-muted me-2"></i><?php echo $row['SDTKH']; ?></div>
                                    </td>

                                    <td style="max-width: 200px;">
                                        <span class="text-secondary small">
                                            <i class="fa-solid fa-location-dot me-1"></i> 
                                            <?php echo !empty($row['DCHIKH']) ? $row['DCHIKH'] : 'Chưa cập nhật'; ?>
                                        </span>
                                    </td>

                                    <td class="text-center no-print">
                                        <a href="QLKH.php?action=delete&id=<?php echo $row['MAKH']; ?>" 
                                           class="btn btn-sm btn-outline-danger"
                                           onclick="return confirm('Cảnh báo: Bạn có chắc chắn muốn xóa khách hàng này không?');"
                                           title="Xóa khách hàng">
                                            <i class="fa-solid fa-trash-can me-1"></i> Xóa
                                        </a>
                                    </td>
                                </tr>
                            <?php 
                                }
                            } else {
                                echo "<tr><td colspan='5' class='text-center py-5 text-muted'>Chưa có khách hàng nào.</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <footer class="bg-white border-top py-3">
        <div class="container text-center">
            <small class="text-muted">&copy;2025. Đồ án cơ sở ngành. Thực hiện bởi Phạm Thị Hồng Phương</small>
        </div>
    </footer>

</body>
</html>