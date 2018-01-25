<?php
	session_start();
	include('functions.php');
	if(isset($_SESSION['uid'])){
		include('mysqli_query.php');

		if(isset($_POST['buy'])){
			print_r($_POST);
			build_buy($_POST['build_id'],$_POST['seller_id'],$_SESSION['uid'],$_POST['build_sell_cost']);
		}
		if(isset($_POST['sell'])){
			build_sell($_POST['build_id'],$_POST['cost']);
		}
		if(isset($_POST['sell_cancel'])){
			build_sell_cancel($_POST['build_id']);
		}


	}
	include('header.php');
	if(isset($_SESSION['uid'])){
?>
<h3>Недвижимость</h3>
<hr>
<div id="realty_sell">
<h4>Ваша недвижимость</h4>
	<div class="row">
		<div class="col-md-1"><b>ID</b></div>
		<div class="col-md-1"><b>Тип</b></div>
		<div class="col-md-3"><b>Адрес</b></div>
		<div class="col-md-1"><b>Доходность</b></div>
		<div class="col-md-1"><b>Стоимость</b></div>
		<div class="col-md-2"><b>Цена продажи $</b></div>
		<div class="col-md-1"><b>Рынок</b></div>
	</div>
<?php
	$build_realty = mysqli_query(connect(),"SELECT * FROM `build` WHERE `build_owner` = '".$_SESSION['uid']."' AND `build_in_sell` = 'no'")or die(mysqli_error());
	while($row = mysqli_fetch_assoc($build_realty)){  
?>
		<form action="realty.php" method="post">
			<div class="row">
				<div class="col-md-1"><?php echo $row['build_id'];?></div>
				<div class="col-md-1"><?php echo $row['build_type'];?></div>
				<div class="col-md-3"><?php echo $row['build_addres'];?></div>
				<div class="col-md-1"><?php echo $row['build_profit'];?></div>
				<div class="col-md-1">$<?php echo $row['build_cost'];?></div>
				<div class="col-md-2"><input type="number" name="cost"></div>
				<div class="col-md-1">
				<input type="hidden" name="build_id" value="<?php echo $row['build_id'];?>">
				<input type="submit" class="btn btn-info" name="sell" value="Продать">
				</div>
			</div>
		</form>
<?php	} ?>	



</div>
<hr>
<div id="realty_buy">
<h4>Рынок недвижимости</h4>
	<div class="row">
		<div class="col-md-1"><b>ID</b></div>
		<div class="col-md-1"><b>Тип</b></div>
		<div class="col-md-3"><b>Адрес</b></div>
		<div class="col-md-2"><b>Доходность</b></div>
		<div class="col-md-1"><b>Ценность</b></div>
		<div class="col-md-1"><b>Цена</b></div>
		<div class="col-md-2"><b>Владелец</b></div>
		<div class="col-md-1"><b>Рынок</b></div>
	</div>

<?php
	//Выборка всех зданий которые выставлены на продажу
	$build_in_sell = mysqli_query(connect(),"SELECT * FROM `build` WHERE `build_in_sell` = 'yes'")or die(mysqli_error());
	//Цикл
	while($row = mysqli_fetch_assoc($build_in_sell)){ 
		//
		$account_in_sell = mysqli_query(connect(),"SELECT `username` FROM `users` WHERE `id` = '".$row['build_owner']."'")or die(mysqli_error());
		$account_in_sell_username = mysqli_fetch_assoc($account_in_sell);
?>		<form action="realty.php" method="post">
			<div class="row">
				<div class="col-md-1"><?php echo $row['build_id'];?></div>
				<div class="col-md-1"><?php echo $row['build_type'];?></div>
				<div class="col-md-3"><?php echo $row['build_addres'];?></div>
				<div class="col-md-2"><?php echo $row['build_profit'];?></div>
				<div class="col-md-1">$<?php echo $row['build_cost'];?></div>
				<div class="col-md-1">$<?php echo $row['build_sell_cost'];?></div>
				<div class="col-md-2"><?php echo $account_in_sell_username['username']."(".$row['build_owner'].")";?></div>
				<div class="col-md-1">
				<input type="hidden" name="build_id" value="<?php echo $row['build_id'];?>">
				<input type="hidden" name="build_sell_cost" value="<?php echo $row['build_sell_cost'];?>">
				<input type="hidden" name="seller_id" value="<?php echo $row['build_owner'];?>">
<?php
				if($row['build_owner'] == $_SESSION['uid']){
					echo '<input type="submit" class="btn btn-warning" name="sell_cancel" value="Отменить">';
				}else{
					echo '<input type="submit" class="btn btn-info" name="buy" value="Купить">';
				}
?>

				</div>
			</div>
		</form>
<?php }?> <!-- Закрытие while -->	
</div>

<?php 
}else{
	header('Location: main.php');
}
	include('footer.php');

?>