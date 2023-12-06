<?php
include $_SERVER['DOCUMENT_ROOT']."/db.php";
$order_id = "SELECT order_id FROM Orders WHERE customer_id='{$_SESSION['customer_id']}' AND order_date IS NULL";
$order_id = mq($order_id)->fetch_object()->order_id;
$sql = "DELETE FROM Order_Details WHERE book_id='{$_GET['book_id']}' AND order_id='$order_id'";
mq($sql);
$sql = "SELECT * FROM Order_Details WHERE order_id='$order_id'";
$result = mq($sql);
if ($result->num_rows == 0) {
    $sql = "DELETE FROM Orders WHERE customer_id='{$_SESSION['customer_id']}' AND order_date IS NULL";
    mq($sql);
    echo "<script type='text/javascript'>alert('삭제되었습니다.');</script>";
    echo "<meta http-equiv='refresh' content='0 url=./cart.php'>";
    exit;
} else {
    $sql = "UPDATE Orders SET total_amount = (SELECT SUM(subtotal) FROM Order_Details WHERE order_id='$order_id') WHERE order_id='$order_id'";
    mq($sql);
    echo "<script type='text/javascript'>alert('삭제되었습니다.');</script>";
    echo "<meta http-equiv='refresh' content='0 url=./cart.php'>";
    exit;
}
?>