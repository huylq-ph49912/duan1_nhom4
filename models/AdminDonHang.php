<?php

class AdminDonHang
{
    private $conn;
    private $table = "chi_tiet_don_hang";
    
    public function __construct($conn)
    {
        $this->conn = $conn;
    }

 // Lấy tất cả các đơn hàng
 public function getAllDonHangs()
{
    try {
        $query = "
            SELECT don_hangs.*, 
                   trang_thai_don_hang.ten_trang_thai AS trang_thai,
                   phuong_thuc_thanh_toan.ten_phuong_thuc AS phuong_thuc_thanh_toan,
                   trang_thai_thanh_toan.ten_trang_thai AS trang_thai_thanh_toan,
                   tai_khoans.ho_ten AS ten_nguoi_dat -- Assuming you want the name of the person who placed the order
            FROM don_hangs
            LEFT JOIN trang_thai_don_hang ON don_hangs.trang_thai_id = trang_thai_don_hang.id
            LEFT JOIN phuong_thuc_thanh_toan ON don_hangs.phuong_thuc_thanh_toan_id = phuong_thuc_thanh_toan.id
            LEFT JOIN trang_thai_thanh_toan ON don_hangs.trang_thai_thanh_toan_id = trang_thai_thanh_toan.id
            LEFT JOIN tai_khoans ON don_hangs.tai_khoan_id = tai_khoans.id
            ORDER BY don_hangs.id DESC
        ";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error fetching orders: " . $e->getMessage();
        return [];
    }
}

 


 // Lấy chi tiết đơn hàng kèm sản phẩm

 // Lấy danh sách sản phẩm theo mã đơn hàng
 public function getOrderProducts($orderId)
 {
     try {
         $query = "
             SELECT san_phams.id, san_phams.ten_san_pham, san_phams.gia_san_pham, 
                    chi_tiet_don_hangs.so_luong
             FROM chi_tiet_don_hangs
             INNER JOIN san_phams ON chi_tiet_don_hangs.san_pham_id = san_phams.id
             WHERE chi_tiet_don_hangs.don_hang_id = :orderId
         ";

         $stmt = $this->conn->prepare($query);
         $stmt->bindParam(':orderId', $orderId, PDO::PARAM_INT);
         $stmt->execute();
         return $stmt->fetchAll(PDO::FETCH_ASSOC);
     } catch (PDOException $e) {
         echo "Error fetching order products: " . $e->getMessage();
         return [];
     }
 }
   //trạng thái đơn hàng
    public function getAllTrangThaiDonHang()
    {
        try {
            $query = "SELECT * FROM trang_thai_don_hang";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error fetching order statuses: " . $e->getMessage();
            return [];
        }
    }

    // trạng thái thanh toán
    public function getAllTrangThaiThanhToan()
    {
        try {
            $query = "SELECT * FROM trang_thai_thanh_toan";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error fetching payment statuses: " . $e->getMessage();
            return [];
        }
    }

    // phương thức thanh toán
    public function getAllPhuongThucThanhToan()
    {
        try {
            $query = "SELECT * FROM phuong_thuc_thanh_toan";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error fetching payment methods: " . $e->getMessage();
            return [];
        }
    }

  

    
    public function updateDonHang($data)
    {
        $query = "UPDATE don_hangs SET 
                    ma_don_hang = :ma_don_hang, 
                    ten_nguoi_nhan = :ten_nguoi_nhan, 
                    email_nguoi_nhan = :email_nguoi_nhan, 
                    sdt_nguoi_nhan = :sdt_nguoi_nhan, 
                    ngay_dat = :ngay_dat, 
                    tong_tien = :tong_tien, 
                    trang_thai_id = :trang_thai_id, 
                    phuong_thuc_thanh_toan_id = :phuong_thuc_thanh_toan_id, 
                    trang_thai_thanh_toan_id = :trang_thai_thanh_toan_id 
                  WHERE id = :id";
    
        $stmt = $this->conn->prepare($query);
    
        return $stmt->execute([
            ':ma_don_hang' => $data['ma_don_hang'],
            ':ten_nguoi_nhan' => $data['ten_nguoi_nhan'],
            ':email_nguoi_nhan' => $data['email_nguoi_nhan'],
            ':sdt_nguoi_nhan' => $data['sdt_nguoi_nhan'],
            ':ngay_dat' => $data['ngay_dat'],
            ':tong_tien' => $data['tong_tien'],
            ':trang_thai_id' => $data['trang_thai_id'],
            ':phuong_thuc_thanh_toan_id' => $data['phuong_thuc_thanh_toan_id'],
            ':trang_thai_thanh_toan_id' => $data['trang_thai_thanh_toan_id'],
            ':id' => $data['id']
        ]);
    }
    
    

    public function updateTrangThaiDonHang($donHangId, $trangThaiId)
    {
        // Prepare the SQL query to update the order status
        $query = "UPDATE don_hangs SET trang_thai_id = :trangThaiId WHERE id = :donHangId";
        $stmt = $this->conn->prepare($query);
    
        // Bind parameters
        $stmt->bindParam(':donHangId', $donHangId, PDO::PARAM_INT);
        $stmt->bindParam(':trangThaiId', $trangThaiId, PDO::PARAM_INT);
    
        // Execute the query
        return $stmt->execute();
    }
    

    
    
    public function getOrdersByStatus($status) {
        // Prepare the query based on the status
        if ($status === 'all') {
            $sql = "SELECT * FROM don_hangs"; // Query to get all orders
        } else {
            $sql = "SELECT * FROM don_hangs WHERE trang_thai_id = :status"; // Query to get orders by status
        }
        
        $stmt = $this->conn->prepare($sql);
        
        // Bind the status parameter if it's not 'all'
        if ($status !== 'all') {
            $stmt->bindParam(':status', $status, PDO::PARAM_INT);
        }
        
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }



    public function getDonHangById($id) {
        try {
            $sql = "
                SELECT don_hangs.*, 
                       trang_thai_don_hang.ten_trang_thai AS trang_thai,
                       phuong_thuc_thanh_toan.ten_phuong_thuc AS phuong_thuc_thanh_toan,
                       trang_thai_thanh_toan.ten_trang_thai AS trang_thai_thanh_toan,
                       tai_khoans.ho_ten AS ho_ten,
                       tai_khoans.so_dien_thoai AS sdt_nguoi_dat,
                       tai_khoans.email AS email_nguoi_dat
                FROM don_hangs
                LEFT JOIN trang_thai_don_hang ON don_hangs.trang_thai_id = trang_thai_don_hang.id
                LEFT JOIN phuong_thuc_thanh_toan ON don_hangs.phuong_thuc_thanh_toan_id = phuong_thuc_thanh_toan.id
                LEFT JOIN trang_thai_thanh_toan ON don_hangs.trang_thai_thanh_toan_id = trang_thai_thanh_toan.id
                LEFT JOIN tai_khoans ON don_hangs.tai_khoan_id = tai_khoans.id
                WHERE don_hangs.id = :id
            ";
    
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
    
            $order = $stmt->fetch(PDO::FETCH_ASSOC);
    
            if (!$order) {
                return null;  // If no order found, return null
            }
    
            // Fetch product details
            $products = $this->getOrderProducts($id); // Fetch the order's products
            $order['products'] = $products;
    
            return $order;
        } catch (PDOException $e) {
            echo "Error fetching order details: " . $e->getMessage();
            return null;
        }
    }
    
    


    
    public function getDonHangByMaDonHang($ma_don_hang) {
        $sql = "SELECT * FROM don_hangs WHERE ma_don_hang = :ma_don_hang";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':ma_don_hang', $ma_don_hang, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getDonHangCountByStatus($status) { 
        try {
            // Prepare the query to count orders based on the status
            if ($status === 'all') {
                $sql = "SELECT COUNT(*) FROM don_hangs"; // Count all orders
            } else {
                $sql = "SELECT COUNT(*) FROM don_hangs WHERE trang_thai_id = :status"; // Count orders by status
            }
    
            $stmt = $this->conn->prepare($sql);
    
            // Bind the status parameter if it's not 'all'
            if ($status !== 'all') {
                $stmt->bindParam(':status', $status, PDO::PARAM_INT);
            }
    
            $stmt->execute();
    
            // Fetch the count result
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            
            return $result['COUNT(*)'];
        } catch (PDOException $e) {
            echo "Error counting orders by status: " . $e->getMessage();
            return 0; // Return 0 if there was an error
        }
    }
    
    
    // Delete an order
    public function deleteDonHang($id)
    {
        try {
            $query = "DELETE FROM don_hangs WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Error deleting order: " . $e->getMessage();
            return false;
        }
    }
    public function addOrderDetails($data) {
        try {
            $query = "INSERT INTO chi_tiet_don_hang (don_hang_id, san_pham_id, so_luong) VALUES (:don_hang_id, :san_pham_id, :so_luong)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':don_hang_id', $data['don_hang_id'], PDO::PARAM_INT);
            $stmt->bindParam(':san_pham_id', $data['san_pham_id'], PDO::PARAM_INT);
            $stmt->bindParam(':so_luong', $data['so_luong'], PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Error inserting order details: " . $e->getMessage();
            return false;
        }
    }
    
   
    public function getOrderDetails($orderId)
    {
        try {
            $query = "
                SELECT don_hangs.*, 
                       trang_thai_don_hang.ten_trang_thai AS trang_thai,
                       phuong_thuc_thanh_toan.ten_phuong_thuc AS phuong_thuc_thanh_toan,
                       trang_thai_thanh_toan.ten_trang_thai AS trang_thai_thanh_toan
                FROM don_hangs
                LEFT JOIN trang_thai_don_hang ON don_hangs.trang_thai_id = trang_thai_don_hang.id
                LEFT JOIN phuong_thuc_thanh_toan ON don_hangs.payment_method_id = phuong_thuc_thanh_toan.id
                LEFT JOIN trang_thai_thanh_toan ON don_hangs.trang_thai_thanh_toan_id = trang_thai_thanh_toan.id
                WHERE don_hangs.id = :orderId
            ";
   
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':orderId', $orderId, PDO::PARAM_INT);
            $stmt->execute();
   
            $order = $stmt->fetch(PDO::FETCH_ASSOC);
   
            if (!$order) {
                return null; // Nếu không tìm thấy đơn hàng
            }
   
            $order['products'] = $this->getOrderProducts($orderId);
            return $order;
        } catch (PDOException $e) {
            echo "Error fetching order details: " . $e->getMessage();
            return null;
        }
    }
   

   
} 

?>


