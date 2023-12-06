<!-- 선택된 book_id를 가져와 책의 정보를 띄우는 php 구현 -->
<?php
include $_SERVER['DOCUMENT_ROOT']."/db.php";
$book_id = $_GET['book_id'];
$book_sql = "SELECT * FROM Books WHERE book_id='$book_id'";
$book_result = mq($book_sql);

if ($book_result->num_rows > 0) {
    $row = $book_result->fetch_assoc();
    ?>
    <h2><?php echo $row["title"]; ?></h2>
    <p><strong>저자:</strong> <?php echo $row["author_name"]; ?></p>
    <p><strong>장르:</strong> <?php echo $row["genre"]; ?></p>
    <p><strong>출판일:</strong> <?php echo $row["publication_date"]; ?></p>
    <p><strong>가격:</strong> ₩<?php echo $row["price"]; ?></p>
    <p><strong>재고:</strong> <?php echo $row["stock_quantity"]; ?></p>
    
    <form method="post" action="./cart/add_to_cart.php">
        <input type="hidden" name="book_id" value="<?php echo $book_id; ?>">
        <label for="quantity">구매할 수량:</label>
        <input type="number" id="quantity" name="quantity" min="1" value="1" max="<?php echo $row["stock_quantity"]; ?>">
        <input type="submit" value="장바구니에 추가">
    </form>
    <?php
} else {
    echo "책을 찾을 수 없습니다.";
}
?>