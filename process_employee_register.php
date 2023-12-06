<?php

include $_SERVER['DOCUMENT_ROOT']."/db.php";
// 직원용 폼에서 전달된 정보 가져오기
$name = $_POST['new_name'];
$username = $_POST['new_username'];
$password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
$department_id = $_POST['new_department_id'];
//필수 아님
$email = $_POST['new_email'];
$phone_number = $_POST['new_phone_number'];
$hire_date = $_POST['new_hire_date'];
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
if($department_id == null || $department_id == ''){
	echo "<script>alert('부서번호를 입력해주세요.'); history.back();</script>";
	exit();
}
if($email == null || $email == ''){
	$email = null;
}
if($phone_number == null || $phone_number == ''){
	$phone_number = null;
}
if($hire_date == null || $hire_date == ''){
	$hire_date = null;
}
$id_check = mq("select * from Employee where username='$username'");
	$id_check = $id_check->fetch_array();
	if($id_check >= 1){
		echo "<script>alert('아이디가 이미 존재합니다.'); history.back();</script>";
	}
$department_check = mq("select * from Department where department_id='$department_id'");
	$department_check = $department_check->fetch_array();
	if($department_check == null){
		echo "<script>alert('부서번호가 존재하지 않습니다.'); history.back();</script>";
	}	
	else{
	$sql = mq("insert into Employee (name, username, password, email, phone_number, hire_date, department_id) values('".$name."','".$username."','".$password."','".$email."','".$phone_number."','".$hire_date."','".$department_id."')");
?>
<script type="text/javascript">alert('직원가입 완료되었습니다.');</script>
<meta http-equiv="refresh" content="0 url=/login.php">
<?php }?>
