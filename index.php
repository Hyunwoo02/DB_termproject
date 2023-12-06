<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
?>

<?php include  $_SERVER['DOCUMENT_ROOT']."/db.php"; ?>
<?php 

// if(!isset($_SESSION['username'])){
// 	echo "<script>alert('잘못된 접근입니다. 로그인을 먼저 해주세요.');location.href='login.php';</script>"; 
// 	exit(); #if we do not do this, client can see below contents.
// }
// 사용자 정보 가져오기
$customers_sql = "SELECT * FROM Customers";
$customers_result = mq($customers_sql);

// 책 가져오기
$books_sql = "SELECT * FROM Books";
$books_result = mq($books_sql);

// 직원 정보 가져오기
$employee_sql = "SELECT * FROM Employee";
$employee_result = mq($employee_sql);

if (isset($_SESSION['name'])) {
    echo "안녕하세요, " . $_SESSION['name'] . "님!";
}
?>



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

<body>
    <h1>현우와 병철의 온라인 서점</h1>
    <h2>오늘의 추천 도서</h2>
    <ul>
    <table>
    <thead>
        <tr>
        <td>책 ID</td>
        <td>책 제목</td>
        <td>저자</td>
        <td>출판일</td>
        <td>제고</td>
        <td>가격</td>
        <td>동작</td>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($books_result->num_rows > 0)
            while ($row = $books_result->fetch_assoc()) {
                echo
                '<tr>'
                . '<td>' . $row["book_id"] . '</td>'
                . '<td>' . $row["title"] . '</td>'
                . '<td>' . $row["author_name"] . '</td>'
                . '<td>' . $row["publication_date"] . '</td>'
                . '<td>' . $row["stock_quantity"] . '</td>'
                . '<td>' . $row["price"] . '</td>'
                . '<td><button onclick="location.href=\'book.php?book_id=' . $row["book_id"] . '\'">상세 정보</button></td>'
                . '</tr>'
                ;
            }
        else {
            echo "책이 없습니다.";
        }
        ?>
    </tbody>
    </table>
    </ul>
    <h2>사용자 목록</h2>
    <ul>
        <?php
        if ($customers_result->num_rows > 0) {
            while ($row = $customers_result->fetch_assoc()) {
                echo "<li>식별 ID: " . $row["customer_id"] . " - 사용자 이름: " . $row["name"] . "사용자 ID: " . $row["username"] ." - 주소: " . $row["address"] . " - 전화번호: " . $row["phone_number"] . "</li>";
            }
        } else {
            echo "사용자가 없습니다.";
        }
        ?>
    </ul>
    <h2>직원 목록</h2>
    <ul>
        <?php
        if ($employee_result->num_rows > 0) {
            while ($row = $employee_result->fetch_assoc()) {
                echo "<li>직원 ID: " . $row["employee_id"] . " - 직원 이름: " . $row["name"] . " - 전화번호: " . $row["phone_number"] . "</li>";
            }
        } else {
            echo "직원이 없습니다.";
        }
        ?>
    </ul>
    <?php
    if (isset($_SESSION['username'])) {
        echo "<button onclick=\"location.href='./cart/cart.php'\">장바구니</button>";
        echo "<button onclick=\"location.href='logout.php'\">로그아웃</button>";
    } else {
        echo "<button onclick=\"location.href='login.php'\">로그인</button>";
    }
    if (isset($_SESSION['is_admin'])) {
        echo "<button onclick=\"location.href='admin.php'\">관리자 페이지</button>";
    }
    ?>
</body>
</html>
