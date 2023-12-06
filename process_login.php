<?php	
	include $_SERVER['DOCUMENT_ROOT']."/db.php";

	$password = $_POST['password'];
	$sql = mq("select * from Customers where username='".$_POST['username']."'");
	$users = $sql->fetch_array();
	$hash_pw = $users['password']; 
	$customer_id = $users['customer_id'];

// 로그인 폼에서 전달된 사용자명과 비밀번호 가져오기
$username = $_POST['username'];
$password = $_POST['password'];

// // 입력된 사용자명과 비밀번호를 이용하여 데이터베이스에서 사용자 검색
// $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
// $result = $conn->query($sql);

// if ($result->num_rows > 0) {
//     echo "로그인 성공!";
//     // 로그인 성공 시 추가적인 작업을 수행할 수 있습니다.
// } else {
//     echo "유효하지 않은 사용자명 또는 비밀번호입니다.";
// }
if(password_verify($password, $hash_pw))
{
	$_SESSION['name']=$users["name"];
	$_SESSION['customer_id']=$customer_id;
    $_SESSION['username']=$_POST['username'];
    $_SESSION['ip']=$_SERVER['REMOTE_ADDR']; #for prevent session hijacking 
    echo "<script>alert('로그인 되었습니다.'); location.href='/index.php';</script>";
}else{ 
    echo "<script>alert('유효하지 않은 사용자명 또는 비밀번호입니다'); history.back();</script>";
}
?>