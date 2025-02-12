<?php

require_once 'models/AdminDonHang.php';

class AdminDonHangController
{
    private $conn;
    private $adminDonHang;

    public function __construct()
    {
        $this->conn = connectDB(); // Connect to DB
        $this->adminDonHang = new AdminDonHang($this->conn); // Initialize model
    }

    // Display order list with different statuses
    public function danhSachDonHang()
    {
        $status = isset($_GET['status']) ? $_GET['status'] : 'all';  // Get status from URL

        // Get orders based on status
        $All = ($status === 'all') 
            ? $this->adminDonHang->getAllDonHangs()  // Get all orders
            : $this->adminDonHang->getOrdersByStatus($status); // Filter by status

        // Count orders by status
        $countAll = $this->adminDonHang->getDonHangCountByStatus('all');
        $countPending = $this->adminDonHang->getDonHangCountByStatus(1); // Pending confirmation
        $countConfirmed = $this->adminDonHang->getDonHangCountByStatus(2); // Confirmed
        $countInTransit = $this->adminDonHang->getDonHangCountByStatus(3); // In transit
        $countDelivered = $this->adminDonHang->getDonHangCountByStatus(4); // Delivered
        $countSuccessful = $this->adminDonHang->getDonHangCountByStatus(5); // Successful delivery
        $countFailed = $this->adminDonHang->getDonHangCountByStatus(6); // Failed delivery
        $countCanceled = $this->adminDonHang->getDonHangCountByStatus(7); // Canceled

        // Get order statuses, payment statuses, and methods
        $listTrangThai = $this->adminDonHang->getAllTrangThaiDonHang();
        $listThanhToan = $this->adminDonHang->getAllTrangThaiThanhToan();  // Payment status (Paid/Unpaid)
        $listPhuongThucThanhToan = $this->adminDonHang->getAllPhuongThucThanhToan(); // Payment methods

        // Send data to view
        include '../views/chiTietMuaHang.php'; // Truyền biến $order đến view

    }

    // Edit order
  

   

    // Update order status
    public function capNhatTrangThaiDonHang()
    {
        // Get order ID and new status from request
        $donHangId = $_POST['id'] ?? null;
        $trangThaiId = $_POST['trang_thai_id'] ?? null;

        if ($donHangId && $trangThaiId) {
            // Update order status
            $result = $this->adminDonHang->updateTrangThaiDonHang($donHangId, $trangThaiId);

            if ($result) {
                $_SESSION['success'] = "Cập nhật trạng thái đơn hàng thành công!";
            } else {
                $_SESSION['error'] = "Cập nhật trạng thái đơn hàng thất bại!";
            }
        }

        require_once '../views/chiTietMuaHang.php'; // Truyền biến $order đến view

    }



    public function showDetail($orderId)
{
    $order = $this->adminDonHang->getDonHangById($orderId);
    if ($order) {
        require_once '../views/chiTietMuaHang.php'; // Truyền biến $order đến view
        // Truyền biến $order đến view
    } else {
        echo "Order not found!";
    }
}

    // Delete an order
    public function deleteDonHang($id)
    { 
        if ($this->adminDonHang->deleteDonHang($id)) {
            header("Location: " . BASE_URL_ADMIN . "/?act=don-hang");
            exit();
        } else {
            echo "Không thể xóa đơn hàng này.";
        }
    }
    
}
