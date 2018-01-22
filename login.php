<?php
	session_start();
	include('functions.php');
	if(isset($_POST['login'])){
		$username = $_POST['username'];
		$password = $_POST['password'];
		$login_r = mysqli_query(connect(),"SELECT `id` FROM `users` WHERE `username` = '".$username."' AND `password` = '".md5($password)."'")or die(mysqli_error());
		$login_stats = mysqli_fetch_assoc($login_r);
		$login = mysqli_num_rows($login_r);
		if($login > 0) {
			$_SESSION['uid'] = $login_stats['id'];
			header('Location: main.php');
		}else{
			echo "Неверный пароль!";
		}


	}else{

	}
?>