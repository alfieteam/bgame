<html>
<head>
<title>BizGame v0.9</title>
<meta charset="utf-8">
<style type="text/css">
	header{
		background-color: #FFFF66; 
		border-bottom: 1px black solid;
	}
	div{
		padding-left: 5px;
	}
	div div div{
		padding: 4px;
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
	#content{
		background: #F0F8FF;
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
			<?php if(isset($_SESSION['uid'])){ //Показываем если авторизирован
				
			?>
				<ul class="hr">
					<li><img width="25" height="25" src="img/pages/bar_cash.jpg" title="Наличные" alt="cash"> $<b><?php echo $stats['cash'];?></b></li>
					<li><img width="26" height="25" src="img/pages/bar_income.jpg" title="Доход в день" alt="income"> $0/день(в разработке)</li>
					<li><img width="26" height="25" src="img/pages/bar_worker.jpg" title="Наёмные работники" alt="worker"> 0/0 человек(в разработке)</li>
					<li><img width="30" height="30" src="img/pages/bar_builder.jpg" title="Строители" alt="builder"><b><?php echo $stats['builders_free'];?></b>/<?php echo $stats['builders'];?></li>
					<li><img width="32" height="32" src="img/pages/bar_energy.jpg" title="Энергия" alt="energy"> <b><?php echo $stats['energy'];?></b>/100</li>
					<li><?php echo date('l j - H:i:s', time())?></li>
				</ul>
			<?php }?>
		</div>
	</div>
</header>
<div id="container" >
<div class="row">
	<div class="col-md-2" id="navigation">
		<?php
			if(isset($_SESSION['uid'])){
				//Проверка на окончание работы.
				workv1_check($_SESSION['uid']);
				build_check();




		?>
			<ul>
				<li><a href="main.php"><b>Главная</b>(В разработке)</a></li>
				<li><a href="work.php"><b>Работа</b>(В разработке)</a></li>
				<li><a href="realty.php"><b>Недвижемость</b></a></li>
				<li><a href="#">Бизнес(в проекции)</a></li>
				<li><a href="building.php"><b>Строительство</b>(В разработке)</a></li>
				<li><a href="#">Рейтинг(в проекции)</a></li>
				<li><a href="#">Найм(в проекции)</a></li>
				<li><a href="#">FAQ(в проекции)</a></li>
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


