<?php
	session_start();
	header('Content-Type: text/html; charset=utf-8'); // utf-8\uc778\ucf54\ub529

	// localhost = DB주소, web=DB아이디, 1234=DB비밀번호, post_board="DB이름"
	$db = new mysqli("localhost","user","qwer1234","book_store"); 
	$db->set_charset("utf8");

	function mq($sql)
	{
		global $db;
		#$stmt = $db->prepare($sql);
		return $db->query($sql);

		// if ($params) {
		// 	$types = str_repeat("s", count($params)); // 모든 파라미터를 문자열로 가정
		// 	$stmt->bind_param($types, ...$params);
		// }
	
		// $stmt->execute();
		
		// // get_result를 사용하여 결과를 mysqli_result 객체로 반환
		// return $stmt->get_result();
	}
?>