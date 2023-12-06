<?php	
	include $_SERVER['DOCUMENT_ROOT']."/db.php";

    $booktitle = $_POST['booktitle'];
    $authorname = $_POST['authorname'];

	$sql = "SELECT * FROM Books WHERE title='$booktitle' AND author_name='$authorname'";
    $result = mq($sql);
	$books = $result->fetch_array();
	$genre = $books['genre']; 
	$publication_date = $books['publication_date']; 
    $price = $books['price'];
    $stock_quantity = $books['stock_quantity'];
    $book_id = $books['book_id'];
    echo "책 번호: $book_id<br>";
    echo "책 제목: $booktitle<br>";
    echo "책 저자: $authorname<br>";
    echo "장르: $genre<br>";
    echo "출판일: $publication_date<br>";
    echo "가격: $price<br>";
    echo "개수: $stock_quantity<br>";
?>