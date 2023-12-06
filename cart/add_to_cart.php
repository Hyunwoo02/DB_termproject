<?php
session_start();

include $_SERVER['DOCUMENT_ROOT']."/db.php";
// require_once("cart_func.php");

if (!isset($_SESSION['customer_id'])) {
    echo "<script type='text/javascript'>alert('로그인이 필요합니다.');</script>";
    echo "<meta http-equiv='refresh' content='0 url=/login.php'>";
    exit;
}
//debug


if(isset($_POST['book_id']) && isset($_POST['quantity']) && isset($_SESSION['customer_id']) ) {
    $book_id = $_POST['book_id'];
    $quantity = $_POST['quantity'];
    $sql = "SELECT * FROM Orders WHERE customer_id='{$_SESSION['customer_id']}' AND order_date IS NULL";
    $result = mq($sql);
    if ($result->num_rows == 0) {
        $sql = "INSERT INTO Orders (customer_id, order_date, total_amount) VALUES ('{$_SESSION['customer_id']}', NULL, 0)";
        mq($sql);
        $order_id = $db->insert_id;
        $_SESSION['order_id'] = $order_id;
    } else {
        $row = $result->fetch_assoc();
        $order_id = $row['order_id'];
        $_SESSION['order_id'] = $order_id;
    }
    // 주문 상세 정보에 상품 추가
    // Order_Details에 이미 존재하는 상품인 경우 수량만 증가
    $sql = "SELECT * FROM Order_Details WHERE order_id='$order_id' AND book_id='$book_id'";
    $result = mq($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $quantity += $row['quantity'];
        $subtotal = $db->query("SELECT price FROM Books WHERE book_id='$book_id'")->fetch_object()->price * $quantity;
        $sql = "UPDATE Order_Details SET quantity='$quantity', subtotal=$subtotal WHERE order_id='$order_id' AND book_id='$book_id'";
        mq($sql);
        $sql = "UPDATE Orders SET total_amount = (SELECT SUM(subtotal) FROM Order_Details WHERE order_id='$order_id') WHERE order_id='$order_id'";
        mq($sql);
        echo "<script type='text/javascript'>alert('장바구니에 추가되었습니다.');</script>";
        echo "<meta http-equiv='refresh' content='0 url=./cart.php'>";
        exit;
    }

    $subtotal = $db->query("SELECT price FROM Books WHERE book_id='$book_id'")->fetch_object()->price * $quantity;
    $sql = "INSERT INTO Order_Details (order_id, book_id, quantity, subtotal) VALUES ('$order_id', '$book_id', '$quantity', $subtotal)";
    mq($sql);
    $sql = "UPDATE Orders SET total_amount = (SELECT SUM(subtotal) FROM Order_Details WHERE order_id='$order_id') WHERE order_id='$order_id'";
    mq($sql);
}
?>
<script type="text/javascript">alert('장바구니에 추가되었습니다.');</script>
<meta http-equiv="refresh" content="0 url=./cart.php">

