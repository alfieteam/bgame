<?php
	session_start();
	include('functions.php');
	if(isset($_SESSION['uid'])){
		include('mysqli_query.php');
		//Действие устроится на работу.
		if(isset($_POST['work'])){
			workv1($_POST['work_id'],$_POST['work_pay'],$_SESSION['uid']);
		}


	}
	include('header.php');
	if(isset($_SESSION['uid'])){
?>
<h3>Рынок труда(В разработке)</h3>
<hr>
<div id="#">
<h4>Работа v1(В разработке)</h4>
	<div class="row">
		<div class="col-md-2"><b>Название</b></div>
		<div class="col-md-2"><b>Работодатель</b></div>
		<div class="col-md-2"><b>Зарплата</b></div>
		<div class="col-md-2"><b>Действие</b></div>
	</div>
<?php

	$work_info = mysqli_query(connect(),"SELECT * FROM `workv1`")or die(mysqli_error());
	while($row = mysqli_fetch_assoc($work_info)){

?>
		<form action="work.php" method="post">
			<div class="row">
				<div class="col-md-2"><?php echo $row['workname'];?></div>
				<div class="col-md-2"><?php echo $row['work_owner'];?></div>
				<div class="col-md-2">$<?php echo $row['work_pay'];?>/минута</div>
				<div class="col-md-2">
					<input type="hidden" name="work_id" value="<?php echo $row['id'];?>">
					<input type="hidden" name="work_pay" value="<?php echo $row['work_pay'];?>">
					<?php

						if($work_log['work_status'] == 'in_work'){
							echo '<input type="button" disabled="disabled" class="btn btn-success" value="Вы уже устроены">';
						}else{
							echo '<input type="submit" class="btn btn-info" name="work" value="Устроится">';
						}
					?>
				</div>
			</div>
		</form>	
<?php
}
?>


</div>
<hr>
<div id="#">
<h4>Работа v2(В проекции)</h4>
	<div class="row">
		<div class="col-md-2"><b>Тип</b></div>
		<div class="col-md-2"><b>Страна</b></div>
		<div class="col-md-2"><b>Владелец</b></div>
		<div class="col-md-2"><b>Зарплата</b></div>
		<div class="col-md-2"><b>Инфо</b></div>
		<div class="col-md-2"><b>Действие</b></div>
	</div>

		<form action="work.php" method="post">
			<div class="row">
				<div class="col-md-2"></div>
				<div class="col-md-2"></div>
				<div class="col-md-2"></div>
				<div class="col-md-2"></div>
				<div class="col-md-2"></div>
				<div class="col-md-2">
					<input type="submit" class="btn btn-info" name="#" value="Устроится">
				</div>
			</div>
		</form>	


</div>
<?php 
}else{
	header('Location: main.php');
}
	include('footer.php');

?>