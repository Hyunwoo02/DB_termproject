<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>로그인</title>
</head>

<body>
    <h1>로그인</h1>
    <form action="process_login.php" method="post">
        <label for="username">사용자명:</label><br>
        <input type="text" id="username" name="username"><br>
        <label for="password">비밀번호:</label><br>
        <input type="password" id="password" name="password"><br><br>
        <input type="submit" value="회원 로그인">
        
    </form>
    <form action="employee_login.php" method="post">
        <label for="username">직원 사용자명:</label><br>
        <input type="text" id="username" name="username"><br>
        <label for="password">직원 비밀번호:</label><br>
        <input type="password" id="password" name="password"><br><br>
        <input type="submit" value="직원 로그인">
    </form>
    <form action="register.php" method="post">
        <input type="submit" value="회원가입">
    </form>
    <form action="employee_register.php" method="post">
        <input type="submit" value="직원가입">
    </form>
</body>

</html>
