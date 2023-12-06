<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>책 조회, 삽입, 삭제, 수정</title>
</head>

<body>
    <h2>책 조회</h2>
    <form action="book_check.php" method="post">
        <label for="booktitle">책 제목:</label><br>
        <input type="text" id="booktitle" name="booktitle"><br>
        <label for="authorname">저자 이름:</label><br>
        <input type="text" id="authorname" name="authorname"><br><br>
        <input type="submit" value="조회">
    </form>
    <h2>책 삽입</h2>
    <form action="book_insert.php" method="post">
        <label for="booktitle">책 제목(필수):</label><br>
        <input type="text" id="booktitle" name="booktitle"><br>
        <label for="authorname">저자 이름(필수):</label><br>
        <input type="text" id="authorname" name="authorname"><br>
        <label for="genre">장르(필수):</label><br>
        <input type="text" id="genre" name="genre"><br>
        <label for="publication_date">출판날짜(YYYY-MM-DD)(필수):</label><br>
        <input type="date" id="publication_date" name="publication_date"><br>
        <label for="price">가격(필수):</label><br>
        <input type="number" id="price" name="price", step="0.01"><br>
        <label for="stock_quantity">재고(필수):</label><br>
        <input type="number" id="stock_quantity" name="stock_quantity"><br><br>
        <input type="submit" value="삽입">
    </form>
    <h2>책 삭제</h2>
    <form action="book_delete.php" method="post">
        <label for="booktitle">책 제목:</label><br>
        <input type="text" id="booktitle" name="booktitle"><br>
        <label for="authorname">저자 이름:</label><br>
        <input type="text" id="authorname" name="authorname"><br>
        <label for="publication_date">출판일:</label><br>
        <input type="date" id="publication_date" name="publication_date"><br><br>
        <input type="submit" value="삭제">
    </form>
    <h2>책 수정</h2>
    <form action="book_correction.php" method="post">
        <label> 수정하고자하는 책</label><br>
        <label for="title">책 제목:</label><br>
        <input type="text" id="title" name="title"><br>
        <label for="authorname">저자 이름:</label><br>
        <input type="text" id="authorname" name="authorname"><br>
        <label for="publication_date">출판일:</label><br>
        <input type="date" id="publication_date" name="publication_date"><br><br>
        <label> 수정하고자하는 정보</label><br>
        <label for="newbooktitle">modified 책 제목:</label><br>
        <input type="text" id="newtitle" name="newtitle"><br>
        <label for="newauthorname">modified 저자 이름:</label><br>
        <input type="text" id="newauthorname" name="newauthorname"><br>
        <label for="publication_date">modified 출판일:</label><br>
        <input type="date" id="newpublication_date" name="newpublication_date"><br>
        <label for="newgenre">modified 장르:</label><br>
        <input type="text" id="newgenre" name="newgenre"><br>
        <label for="newprice">modified 가격:</label><br>
        <input type="number" id="newprice" name="newprice", step="0.01"><br>
        <label for="newquantity">modified 재고:</label><br>
        <input type="number" id="newquantity" name="newquantity"><br>
        <input type="submit" value="수정">
    </form>
    <h2>직원 및 부서 정보</h2>
    <form action="employee_department_info.php" method="post">
        <input type="submit" value="정보보기">
    </form>
    <input type="button" value="메인화면" onclick="location.href='index.php'">
</body>

</html>