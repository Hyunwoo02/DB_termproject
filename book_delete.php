<?php	
	include $_SERVER['DOCUMENT_ROOT']."/db.php";

    $booktitle = $_POST['booktitle'];
    $authorname = $_POST['authorname'];
	$publication_date = $_POST['publication_date']; 

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
    $id_check = mq("select * from Books where title='$booktitle' and author_name='$authorname' and publication_date='$publication_date'");
    $id_check = $id_check->fetch_array();
    if($id_check>=1){
        $sql = mq("delete from Books where title='$booktitle' and author_name='$authorname' and publication_date='$publication_date'");
        echo "<script>alert('성공적으로 삭제되었습니다.'); </script>";
        echo "<meta http-equiv='refresh' content='0 url=/'>";
    }
    else{
        echo "<script>alert('존재하지 않는 책입니다. 삭제를 할 수 없습니다.'); history.back();</script>";
    }
?>