<?php

include $_SERVER['DOCUMENT_ROOT']."/db.php";

// 회원가입 폼에서 전달된 정보 가져오기
$name = $_POST['new_name'];
$username = $_POST['new_username'];
$password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
//필수 아님
$email = $_POST['new_email'];
$address = $_POST['new_address'];
$phone_number = $_POST['new_phone_number'];
//필수값 검사
if($username == null || $username == ''){
	echo "<script>alert('아이디를 입력해주세요.'); history.back();</script>";
	exit();
}
if($name == null || $name == ''){
	echo "<script>alert('이름을 입력해주세요.'); history.back();</script>";
	exit();
}
if($password == null || $password == ''){
	echo "<script>alert('비밀번호를 입력해주세요.'); history.back();</script>";
	exit();
}

if($email == null || $email == ''){
	$email = null;
}
if($address == null || $address == ''){
	$address = null;
}
if($phone_number == null || $phone_number == ''){
	$phone_number = null;
}


$id_check = mq("select * from Customers where username='$username'");
	$id_check = $id_check->fetch_array();
	if($id_check >= 1){
		echo "<script>alert('아이디가 이미 존재합니다.'); history.back();</script>";
	}else{
$sql = mq("insert into Customers (name, username, password, email, address, phone_number) values('".$name."','".$username."','".$password."','".$email."','".$address."','".$phone_number."')");
?>
<script type="text/javascript">alert('회원가입 완료되었습니다.');</script>
<meta http-equiv="refresh" content="0 url=/login.php">
<?php } ?>
