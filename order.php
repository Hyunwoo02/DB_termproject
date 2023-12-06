<?php
include $_SERVER['DOCUMENT_ROOT']."/db.php";
// 주문 완료 프로세스. Orders의 order_date update. Order_Details의 quantity update. Books의 stock_quantity update.
// 주문 완료 프로세스 코드 작성
function order() {
    if (isset($_SESSION['customer_id'])) {
        $sql = "SELECT * FROM Orders WHERE customer_id='{$_SESSION['customer_id']}' AND order_date IS NULL";
        $result = mq($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $order_id = $row['order_id'];
            $sql = "UPDATE Orders SET order_date=NOW() WHERE order_id='$order_id'";
            mq($sql);
            $sql = "SELECT * FROM Order_Details WHERE order_id='$order_id'";
            $result = mq($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $book_id = $row['book_id'];
                    $quantity = $row['quantity'];
                    $sql = "SELECT stock_quantity FROM Books WHERE book_id='$book_id'";
                    $stock_quantity = mq($sql)->fetch_object()->stock_quantity;
                    if ($stock_quantity < $quantity) {
                        echo "<script type='text/javascript'>alert('재고가 부족합니다.');</script>";
                        echo "<meta http-equiv='refresh' content='0 url=/cart.php'>";
                        exit;
                    }
                    $sql = "UPDATE Books SET stock_quantity=stock_quantity-'$quantity' WHERE book_id='$book_id'";
                    mq($sql);
                }
            }
            echo "<script type='text/javascript'>alert('주문이 완료되었습니다.');</script>";
            echo "<meta http-equiv='refresh' content='0 url=/'>";
            exit;
        }
    }    
}
order();
?>
