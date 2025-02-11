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
        include './views/donhang/listDonHang.php';
    }

    // Edit order
    public function fromEditDonHang($id) {
        // Fetch the order details
        $order = $this->adminDonHang->getDonHangById($id);
        $listTrangThai = $this->adminDonHang->getAllTrangThaiDonHang();  // Fetch the statuses
    
        // Pass the data to the view
        require './views/donhang/editDonHang.php';  // Adjust the path as necessary
    }
    


    public function capNhatTrangThaiDonHang()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $orderId = $_POST['id'];
            $trangThaiId = $_POST['trang_thai_id'];

          
            if (empty($orderId) || empty($trangThaiId)) {
                $_SESSION['error'] = "Thông tin không đầy đủ!";
                header("Location: " . BASE_URL_ADMIN . "/?act=don-hang");
                exit();
            }    
            $updateResult = $this->adminDonHang->updateTrangThaiDonHang($orderId, $trangThaiId);     
            if ($updateResult) {
                $_SESSION['success'] = "Cập nhật trạng thái đơn hàng thành công!";
            } else {
                $_SESSION['error'] = "Cập nhật trạng thái đơn hàng thất bại!";
            }

          
            echo "Some output";
            header("Location: " . BASE_URL_ADMIN . "/?act=don-hang");
            
            exit();
        } else {
            // Handle invalid request method
            $_SESSION['error'] = "Yêu cầu không hợp lệ!";
            header("Location: " . BASE_URL_ADMIN . "/?act=don-hang");
            exit();
        }
    }

    public function showDetail($orderId)
    {
        $order = $this->adminDonHang->getDonHangById($orderId);
        $listTrangThai = $this->adminDonHang->getAllTrangThaiDonHang();  // Get all available statuses

        if ($order) {
            // If the order exists, include the view and pass the order and status data
            include './views/donhang/detailDonHang.php'; // Pass $order and $listTrangThai to the view
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

    public function detailDonHang()
    {
        if (isset($_GET['id'])) {
            $orderId = $_GET['id'];

            // Fetch order details from the model
            $order = $this->adminDonHang->getDonHangById($orderId);
            $listTrangThai = $this->adminDonHang->getAllTrangThaiDonHang();

            // Pass data to the view
            require './views/donhang/detailDonHang.php'; // Assuming this is your detail page
        } else {
            $_SESSION['error'] = "Không tìm thấy đơn hàng!";
            header("Location: " . BASE_URL_ADMIN . "/?act=don-hang");
            exit();
        }
    }


    public function capNhatDonHang()
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Get the order details from the form submission
        $orderId = $_POST['id'];
        $orderStatus = $_POST['trang_thai_id'];
        $paymentStatus = $_POST['thanh_toan_id'];
        $paymentMethod = $_POST['phuong_thuc_thanh_toan_id'];

        // Validate the input data
        if (empty($orderId) || empty($orderStatus) || empty($paymentStatus) || empty($paymentMethod)) {
            $_SESSION['error'] = "Thông tin không đầy đủ!";
            header("Location: " . BASE_URL_ADMIN . "/?act=edit-don-hang&id=$orderId");
            exit();
        }

        // Update the order in the database
        $updateResult = $this->adminDonHang->updateDonHang($orderId, $orderStatus, $paymentStatus, $paymentMethod);

        // Check if the update was successful
        if ($updateResult) {
            $_SESSION['success'] = "Cập nhật đơn hàng thành công!";
        } else {
            $_SESSION['error'] = "Cập nhật đơn hàng thất bại!";
        }

        // Redirect to the order list
        header("Location: " . BASE_URL_ADMIN . "/?act=don-hang");
        exit();
    } else {
        // Handle invalid request method
        $_SESSION['error'] = "Yêu cầu không hợp lệ!";
        header("Location: " . BASE_URL_ADMIN . "/?act=don-hang");
        exit();
    }
}


}
