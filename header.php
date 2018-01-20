<html>
<head>
<title>BizGame</title>
<style type="text/css">
	header{
		background-color: #FFFF66; 
		border-bottom: 1px black solid;
	}
	div{
		padding-left: 5px;
	}
	header a{
		color: black;
	}
	footer{
		border-top: 1px black solid;
		background-color: #DCDCDC;
	}
	table tr td{
		border: 1px black solid;
	}
	#realty{
	}
	#navigation{
		padding-top: 7px;
		border-right: 1px black solid;
	}	
	#working{
	}
	ul.hr {
	    margin: 0; /* Обнуляем значение отступов */
	    padding: 6px; /* Значение полей */
    }
    ul.hr li {
	    display: inline; /* Отображать как строчный элемент */
	    margin-right: 7px; /* Отступ слева */
	    padding: 5px; /* Поля вокруг текста */
    }
</style>
<link rel="stylesheet" type="text/css" href="style.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<body>
<header>
	<div class="row">
		<div class="col-md-2">
			<a href="main.php" class="navbar-brand"><b>BigBiz Games</b></a>
		</div>
		<div class="col-md-10" align="center">
			<?php if(isset($_SESSION['uid'])){ //Показываем если авторизирован?>
				<ul class="hr">
					<li>Деньги: $0(в разработке)</li>
					<li>Доход: $0/день(в разработке)</li>
					<li>Енергия: 0/0(в разработке)</li>
					<li>Найм: 0 человек(в разработке)</li>
				</ul>
			<?php } // закрытие if?>
		</div>
	</div>
</header>
<div id="container" >
<div class="row">
	<div class="col-md-2" id="navigation">
		<?php
			if(isset($_SESSION['uid'])){
		?>
			<ul>
				<li><a href="#">Работа</a></li>
				<li><a href="#">Недвижемости</a></li>
				<li><a href="#">Бизнес</a></li>
				<li><a href="#">Строительство</a></li>
				<li><a href="#">Рейтинг</a></li>
				<li><a href="#">FAQ</a></li>
				<li><a href="logout.php">Выход</a></li>
			</ul>
		<?php }else{ ?>
			<form action="login.php" method="post">
					<div class="row">
						<div class="col-md-3">Логин:</div>
						<div class="col-md-9"><input type="text" name="username"></div>
					</div>
					<div class="row">
						<div class="col-md-3" >Пароль:</div>
						<div class="col-md-9"><input type="password" name="password"></div>
					</div>
					<div class="row">
						<div class="col-md-12" ><input type="submit" class="btn btn-success" name="login" value="Войти"></div>
					</div>
					<div class="row">
						<div class="col-md-12" ><a href="registration.php">Регистрация</a></div>
					</div>
			</form>
		<?php
		}

		?>
	</div>
	<div id="content" class="col-md-10">


