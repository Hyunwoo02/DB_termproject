<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>회원가입</title>
</head>

<body>
    <h1>회원가입</h1>
    <form action="process_register.php" method="post">
        <label for="new_name">이름:</label><br>
        <input type="text" id="new_name" name="new_name"><br>
        <label for="new_username">아이디:</label><br>
        <input type="text" id="new_username" name="new_username"><br>
        <label for="new_password">비밀번호:</label><br>
        <input type="password" id="new_password" name="new_password"><br><br>
        <h2>선택사항</h2>
        <label for="new_email">이메일:</label><br>
        <input type="text" id="new_email" name="new_email"><br>
        <label for="new_address">주소:</label><br>
        <input type="text" id="new_address" name="new_address"><br>
        <label for="new_phone_number">전화번호:</label><br>
        <input type="text" id="new_phone_number" name="new_phone_number"><br>
        <input type="submit" value="회원가입">
    </form>
</body>

</html>
