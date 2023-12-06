<?php	
	include $_SERVER['DOCUMENT_ROOT']."/db.php";

    $sql = "SELECT Employee.*, Department.* FROM Employee INNER JOIN Department ON Employee.department_id = Department.department_id";
    $result = $db->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>직원 및 부서 정보</title>
</head>
<body>

<table border="1">
    <tr>
        <th>직원 ID</th>
        <th>이름</th>
        <th>이메일</th>
        <th>전화번호</th>
        <th>고용일</th>
        <th>부서 ID</th>
        <th>사용자명</th>
        <th>비밀번호</th>
        <th>부서명</th>
        <th>위치</th>
        <!-- 필요에 따라 추가 컬럼 -->
    </tr>
    <?php
    if ($result->num_rows > 0) {
        // 결과를 행별로 출력
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["employee_id"] . "</td>";
            echo "<td>" . $row["name"] . "</td>";
            echo "<td>" . $row["email"] . "</td>";
            echo "<td>" . $row["phone_number"] . "</td>";
            echo "<td>" . $row["hire_date"] . "</td>";
            echo "<td>" . $row["department_id"] . "</td>";
            echo "<td>" . $row["username"] . "</td>";
            echo "<td>" . $row["password"] . "</td>";
            echo "<td>" . $row["department_name"] . "</td>";
            echo "<td>" . $row["location"] . "</td>";
            // 필요에 따라 추가 컬럼
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='10'>결과가 없습니다.</td></tr>";
    }
    ?>
</table>

</body>
</html>
