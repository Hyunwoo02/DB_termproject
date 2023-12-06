<?php
include $_SERVER['DOCUMENT_ROOT']."/db.php";
// 장바구니에 상품 추가 Orders, Order_Details 테이블에 추가
function addToCart($product, $quantity = 1) {

}

// 장바구니 내용 확인
function viewCart() {
    if (isset($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $product) {
            $sql = "SELECT * FROM Books WHERE book_id='$product'";
            $result = mq($sql);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                echo "<p>{$row['title']} ({$row['author_name']})</p>";
            }
        }
    } else {
        echo "장바구니가 비어 있습니다.";
    }
}

// 장바구니에서 상품 제거
function removeFromCart($index) {
    if (isset($_SESSION['cart'][$index])) {
        unset($_SESSION['cart'][$index]);
    }
}

// 장바구니 비우기
function clearCart() {
    $_SESSION['cart'] = array();
}

// 사용 예시
// addToCart("상품 1");
// addToCart("상품 2");
// addToCart("상품 3");

// viewCart(); // 장바구니 내용 확인

// removeFromCart(1); // 인덱스 1의 상품 제거

// viewCart(); // 장바구니 내용 확인

// clearCart(); // 장바구니 비우기

// viewCart(); // 장바구니 내용 확인
?>