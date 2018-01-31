<?php
	session_start();
	include('functions.php');
	include('header.php');
	if(isset($_POST['register'])){
		$username = $_POST['username'];
		$password = md5($_POST['password']);
		$email = $_POST['email'];
		$register = mysqli_query(connect(),"INSERT INTO `users` SET 
											`username` = '".$username."',
											`password` = '".$password."',
											`email` = '".$email."'");
		$register_stats = mysqli_query(connect(),"INSERT INTO `stats` SET 
											`cash` = '0',
											`energy` = '100',
											`builders` = '1',
											`builders_free` = '1',
											`builders_in_use` = '0'");
		echo "Вы успешно зарегистрировались!";
	}
	if(!isset($_SESSION['uid'])){
?>

<h2 style="text-align: center;">Регистрация</h2>
<form action="registration.php" method="post">
					<div class="row">
						<div class="col-md-3">Логин:</div>
						<div class="col-md-9"><input type="text" name="username"></div>
					</div>
					<div class="row">
						<div class="col-md-3" >Пароль:</div>
						<div class="col-md-9"><input type="password" name="password"></div>
					</div>
					<div class="row">
						<div class="col-md-3" >E-mail:</div>
						<div class="col-md-9"><input type="email" name="email"></div>
					</div>
					<div class="row">
						<div class="col-md-12" ><input type="submit" class="btn btn-success" name="register" value="Зарегистрировать"></div>
					</div>
					<div class="row">
						<div class="col-md-12" ><a href="registration.php">Регистрация</a></div>
					</div>
			</form>


<?php }else{ 
	header('Location: main.php');
}
	include('footer.php');
?>