<?php
	session_start();
	include('functions.php');
	if(isset($_SESSION['uid'])){
		include('mysqli_query.php');
	}
	include('header.php');
	if(isset($_SESSION['uid'])){
		include('lib/work_class.php');

		if(isset($_POST['save_work'])){
			echo "Применено";
			print_r($_POST);
			$work = new Work;
			//Устанавливаем время
			if(isset($_POST['worktime'])){
				if($_POST['worktime'] == '') echo fail('Время не указано');
				else {
					$work->set_work_time(0,$_POST['worktime']);//Непонятно как получить Work ID
					echo success('Время успешно назначено!');
				}
			}
			//устанавливаем зарплату
			if(isset($_POST['workpay'])){
				if($_POST['workpay'] == '') echo fail('Зарплата не указана');
				else {
					$work->set_work_pay(0,$_POST['workpay']);//Непонятно как получить Work ID
					echo success('Зарплата успешно назначена!');
				}
			}
			//Устанавливаем название Работы
			if(isset($_POST['workname'])){
				if($_POST['workname'] == '') echo fail('Вы не ввели название');
				else {
					$work->set_work_name(0,$_POST['workname']);//Непонятно как получить Work ID
					echo success('Название успешно назначено!');
				}
			}else{
				echo "Вы не ввели никаких данных для изменения!";
			}
		}

?>


<h3>Название компании(В разработке)</h3>
<hr>
<h5>Настройки работы(В разработке)</h5>
<form action="business_menu.php" method="post">
	<div class="row">
		<div class="col-md-3"><b>Work ID</b></div>
		<div class="col-md-3"><b>Название</b></div>
		<div class="col-md-3"><b>Зарплата</b></div>
		<div class="col-md-3"><b>Время работы</b></div>
	</div>
	<div class="row">
		<div class="col-md-3"><?php echo "ID работы";?></div>
		<div class="col-md-3"><?php echo "Coca Cola Corp.";?></div>
		<div class="col-md-3">$<?php echo 100;?></div>
		<div class="col-md-3"><?php echo 300;?> сек</div>
	</div>
	<div class="row">
		<div class="col-md-3"><?php echo "ID: 14";?></div>
		<div class="col-md-3"><input type="text" name="workname"></div>
		<div class="col-md-3"><input type="number" name="workpay"></div>
		<div class="col-md-3"><input type="number" name="worktime"></div>
	</div>
	<div class="row">
		<div class="col-md-12"><input type="submit" name="save_work" value="Применить"></div>
	</div>
</form>
<?php
	
?>
<hr>




<?php
	include('footer.php');
}
?>