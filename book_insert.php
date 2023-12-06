<?php	
	include $_SERVER['DOCUMENT_ROOT']."/db.php";

    $booktitle = $_POST['booktitle'];
    $authorname = $_POST['authorname'];
    $genre = $_POST['genre']; 
	$publication_date = $_POST['publication_date']; 
    $price = $_POST['price'];
    $stock_quantity = $_POST['stock_quantity'];

    if ($booktitle == null || $booktitle==''){
        echo "<script>alert('책 제목을 입력해주세요.'); history.back();</script>";
        exit();
    }
    if ($authorname == null || $authorname==''){
        echo "<script>alert('저자를 입력해주세요.'); history.back();</script>";
        exit();
    }
    if ($genre == null || $genre==''){
        echo "<script>alert('장르를 입력해주세요.'); history.back();</script>";
        exit();
    }

    if ($publication_date == null || $publication_date==''){
        echo "<script>alert('출판일을 입력해주세요.'); history.back();</script>";
        exit();
    }

    if ($price == null || $price==''){
        echo "<script>alert('가격을 입력해주세요.'); history.back();</script>";
        exit();
    }

    if ($stock_quantity == null || $stock_quantity==''){
        echo "<script>alert('재고를 입력해주세요.'); history.back();</script>";
        exit();
    }
    $id_check = mq("select * from Books where title='$booktitle' and author_name='$authorname' and publication_date='$publication_date'");
    $id_check = $id_check->fetch_array();
    if($id_check>=1){
        echo "<script>alert('이미 존재하는 책입니다. 수량을 수정해주세요'); history.back();</script>";
    }
    else{
        $sql = mq("insert into Books (title, author_name, genre, publication_date, price, stock_quantity) values('".$booktitle."','".$authorname."','".$genre."','".$publication_date."','".$price."','".$stock_quantity."')");
        echo "<script>alert('$booktitle, $authorname, $genre, $publication_date, $price, $stock_quantity 가 삽입되었습니다.');</script>";
        echo "<meta http-equiv='refresh' content='0 url=/'>";
    }
?>