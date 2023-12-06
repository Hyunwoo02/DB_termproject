<head>
    <meta charset="UTF-8">
    <title>현우와 병철의 온라인 서점</title>
    <style>
      body {
        font-family: Consolas, monospace;
        font-family: 12px;
      }
      table {
        width: 100%;
      }
      th, td {
        padding: 10px;
        border-bottom: 1px solid #dadada;
      }
    </style>
</head>
<h1>장바구니</h1>
<table>
<thead>
<tr>
<td>책 제목</td>
<td>저자</td>
<td>출판일</td>
<td>가격</td>
<td>수량</td>
<td>소계</td>
<td>동작</td>
</tr>
</thead>
<tbody>
<?php
// require_once("cart_func.php");
include $_SERVER['DOCUMENT_ROOT']."/db.php";
session_start();

// 장바구니 상품 표시. 장바구니가 비어 있으면 비어 있음을 표시 Orders, Order_Details 활용. order_date = NULL 인 경우 주문이 완료되지 않은 것으로 간주
function viewCart() {
    
}

if (isset($_SESSION['customer_id'])) {
    $sql = "SELECT * FROM Orders WHERE customer_id='{$_SESSION['customer_id']}' AND order_date IS NULL";
    $result = mq($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $order_id = $row['order_id'];
        $sql = "SELECT * FROM Order_Details WHERE order_id='$order_id'";
        $result = mq($sql); // Order_Details 테이블에서 상품 정보 가져오기
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $book_id = $row['book_id'];
                $sql = "SELECT * FROM Books WHERE book_id='$book_id'";
                $result2 = mq($sql); // Books 테이블에서 상품 정보 가져오기
                if ($result2->num_rows > 0) {
                    $row2 = $result2->fetch_assoc();
                    echo '<tr>'
                    . '<td>' . $row2["title"] . '</td>'
                    . '<td>' . $row2["author_name"] . '</td>'
                    . '<td>' . $row2["publication_date"] . '</td>'
                    . '<td>' . $row2["price"] . '</td>'
                    . '<td>' . $row['quantity'] . '</td>'
                    . '<td>' . $row['subtotal'] . '</td>'
                    . '<td><a href="./remove_from_cart.php?book_id=' . $row2["book_id"] . '"><button>삭제</button></a></td>'
                    . '</tr>'
                    ;
                }
            }
            $sql = "SELECT SUM(subtotal) AS subtotal_sum FROM Order_Details WHERE order_id IN (SELECT order_id FROM Orders WHERE customer_id='{$_SESSION['customer_id']}' AND order_date IS NULL)";
            $result = mq($sql);
            $subtotal_sum = $result->fetch_object()->subtotal_sum;
            echo "<tr><td colspan='7'>주문예정총액 : $subtotal_sum</td></tr>";
        } else {
            echo "<tr><td colspan='7'>장바구니가 비어 있습니다.</td></tr>";
        }
    } else {
        echo "<tr><td colspan='7'>장바구니가 비어 있습니다.</td></tr>";
    }
} else {
    echo "<tr><td colspan='7'>로그인이 필요합니다.</td></tr>";
}

?>
</tbody>
</table>

<h1>주문 완료 목록</h1>
<table>
<thead>
<tr>
<td>책 제목</td>
<td>저자</td>
<td>출판일</td>
<td>가격</td>
<td>수량</td>
<td>소계</td>
<td>주문일</td>
</tr>
</thead>
<tbody>
<?php
if (isset($_SESSION['customer_id'])){
    $sql = "SELECT * FROM Orders WHERE customer_id='{$_SESSION['customer_id']}' AND order_date IS NOT NULL";
    $result = mq($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $order_id = $row['order_id'];
            $sql = "SELECT * FROM Order_Details WHERE order_id='$order_id'";
            $result3 = mq($sql); // Order_Details 테이블에서 상품 정보 가져오기
            if ($result3->num_rows > 0) {
                while ($row3 = $result3->fetch_assoc()) {
                    $book_id = $row3['book_id'];
                    $sql = "SELECT * FROM Books WHERE book_id='$book_id'";
                    $result2 = mq($sql); // Books 테이블에서 상품 정보 가져오기
                    if ($result2->num_rows > 0) {
                        $row2 = $result2->fetch_assoc();
                        echo '<tr>'
                        . '<td>' . $row2["title"] . '</td>'
                        . '<td>' . $row2["author_name"] . '</td>'
                        . '<td>' . $row2["publication_date"] . '</td>'
                        . '<td>' . $row2["price"] . '</td>'
                        . '<td>' . $row3['quantity'] . '</td>'
                        . '<td>' . $row3['subtotal'] . '</td>'
                        . '<td>' . $row['order_date'] . '</td>'
                        . '</tr>'
                        ;
                    }
                }
                echo "<tr><td colspan='7'>총액 : " . $db->query("SELECT total_amount FROM Orders WHERE order_id='$order_id'")->fetch_object()->total_amount . "</td></tr>";
            } else {
                echo "<tr><td colspan='7'>주문 내역이 없습니다.</td></tr>";
            }
        }
    }


}
?>
</tbody>
</table>
<?php
//주문하기 버튼
if (isset($_SESSION['customer_id'])) {
    echo "<button onclick=\"location.href='../order.php?order_id=$order_id'\">주문하기</button>";
}
//뒤로가기 버튼
echo "<button onclick=\"location.href='../index.php'\">뒤로가기</button>";