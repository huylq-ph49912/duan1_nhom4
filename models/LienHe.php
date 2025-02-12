<?php

class LienHeModel {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Thêm liên hệ vào database
    public function themLienHe($ten_lien_he, $email, $thong_tin, $trang_thai) {
        // Câu lệnh SQL để thêm thông tin vào bảng lien_hes
        $sql = "INSERT INTO lien_hes (ten_lien_he, email, thong_tin, trang_thai) 
                VALUES (:ten_lien_he, :email, :thong_tin, :trang_thai)";
        
        // Chuẩn bị câu lệnh SQL
        $stmt = $this->conn->prepare($sql);

        // Bind giá trị
        $stmt->bindParam(':ten_lien_he', $ten_lien_he); 
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':thong_tin', $thong_tin);
        $stmt->bindParam(':trang_thai', $trang_thai);

        // Thực thi câu lệnh và trả về kết quả
        return $stmt->execute();
    }
}
?>
