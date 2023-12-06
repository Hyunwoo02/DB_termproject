<?php	
	include $_SERVER['DOCUMENT_ROOT']."/db.php";

    $booktitle = $_POST['title'];
    $authorname = $_POST['authorname'];
	$publication_date = $_POST['publication_date']; 

    $newtitle = $_POST['newtitle'];
    $newauthorname = $_POST['newauthorname'];
    $newpublication_date = $_POST['newpublication_date'];
    $newgenre = $_POST['newgenre'];
    $newprice = $_POST['newprice'];
    $newquantity = $_POST['newquantity'];

    if ($booktitle == null || $booktitle==''){
        echo "<script>alert('책 제목을 입력해주세요.'); history.back();</script>";
        exit();
    }
    if ($authorname == null || $authorname==''){
        echo "<script>alert('저자를 입력해주세요.'); history.back();</script>";
        exit();
    }
    if ($publication_date == null || $publication_date==''){
        echo "<script>alert('출판일을 입력해주세요.'); history.back();</script>";
        exit();
    }
    $prev_genre=null;
    $prev_price=null;
    $prev_quantity=null;

    $id_check = mq("select * from Books where title='$booktitle' and author_name='$authorname' and publication_date='$publication_date'");
    $id_check = $id_check->fetch_array();
    if($id_check>=1){
        $prev_genre = $id_check['genre'];
        $prev_price = $id_check['price'];
        $prev_quantity = $id_check['stock_quantity'];
        if ($newtitle==""){
            $newtitle = $booktitle;
        }
        if ($newauthorname==""){
            $newauthorname = $authorname;
        }
        if ($newpublication_date ==""){
            $newpublication_date = $publication_date;
        }
        if ($newgenre == ""){
            $newgenre = $prev_genre;
        }
        if ($newprice == ""){
            $newprice = $prev_price;
        }
        if ($newquantity == ""){
            $newquantity = $prev_quantity;
        }
        // echo "$booktitle<br>";
        // echo "$authorname<br>";
        // echo "$publication_date<br>";
        // echo "$newtitle<br>";
        // echo "$newauthorname<br>";
        // echo "$newpublication_date<br>";
        // echo "$newgenre<br>";
        // echo "$newprice<br>";
        // echo "$newquantity<br>";
    
        mq("update Books set title='$newtitle', author_name='$newauthorname', publication_date='$newpublication_date', genre='$newgenre', price='$newprice', stock_quantity='$newquantity' where title='$booktitle' and author_name='$authorname' and publication_date='$publication_date'");
        echo "<script>alert('수정되었습니다.');</script>";
        echo "<meta http-equiv='refresh' content='0 url=/'>";
    }
    else{
        echo "<script>alert('존재하지 않는 책입니다. 수정을 할 수 없습니다.'); history.back();</script>";
    }
?>