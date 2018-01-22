<?php
	session_start();
	include('functions.php');
	include('header.php');
	if(isset($_SESSION['uid'])){
?>
<h3>Недвижимость(В разработке)</h3>
<hr>
<div id="realty_sell">
<h4>Ваша недвижимость(В разработке)</h4>
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
	$build_realty = mysqli_query(connect(),"SELECT * FROM `build` WHERE `build_owner` = '".$_SESSION['uid']."'")or die(mysqli_error());
	while($row = mysqli_fetch_assoc($build_realty)){
		//Не выводит первое значение
		echo "<div class=\"row\">";
			echo "<div class=\"col-md-1\">".$row['build_id']."</div>";
			echo "<div class=\"col-md-1\">".$row['build_type']."</div>";
			echo "<div class=\"col-md-3\">".$row['build_addres']."</div>";
			echo "<div class=\"col-md-1\">".$row['build_profit']."</div>";
			echo "<div class=\"col-md-1\">".$row['build_cost']."</div>";
			echo "<div class=\"col-md-2\"><input type=\"number\" name=\"cost\"></div>";
			echo "<div class=\"col-md-1\"><input type=\"submit\" class=\"btn btn-info\" name=\"sell\" value=\"Продать\"></div>";
		echo "</div>";
	}
?>	



</div>
<hr>
<div id="realty_buy">
<h4>Рынок недвижимость(В проекции)</h4>
	<div class="row">
		<div class="col-md-1"><b>ID</b></div>
		<div class="col-md-1"><b>Тип</b></div>
		<div class="col-md-3"><b>Адрес</b></div>
		<div class="col-md-2"><b>Доходность</b></div>
		<div class="col-md-1"><b>Цена</b></div>
		<div class="col-md-2"><b>Владелец</b></div>
		<div class="col-md-1"><b>Рынок</b></div>
	</div>



<?php

	$build_in_sell = mysqli_query(connect(),"SELECT * FROM `build` WHERE `build_in_sell` = 'yes'")or die(mysqli_error());
	while($row = mysqli_fetch_assoc($build_in_sell)){
		//Не выводит первое значение
		echo "<div class=\"row\">";
			echo "<div class=\"col-md-1\">".$row['build_id']."</div>";
			echo "<div class=\"col-md-1\">".$row['build_type']."</div>";
			echo "<div class=\"col-md-3\">".$row['build_addres']."</div>";
			echo "<div class=\"col-md-2\">".$row['build_profit']."</div>";
			echo "<div class=\"col-md-1\">".$row['build_cost']."</div>";
			$account_in_sell = mysqli_query(connect(),"SELECT `username` FROM `users` WHERE `id` = '".$row['build_owner']."'")or die(mysqli_error());
			$account_in_sell_username = mysqli_fetch_assoc($account_in_sell);
			echo "<div class=\"col-md-2\">".$account_in_sell_username['username']."(".$row['build_owner'].")</div>";
			echo "<div class=\"col-md-1\"><input type=\"submit\" class=\"btn btn-info\" name=\"buy\" value=\"Купить\"></div>";
		echo "</div>";
	}
?>	
</div>
Если на рынке своя недвижимость, то вместо купить - Отменить.
<input type="submit" class="btn btn-warning" name="cancel" value="Отменить">

<?php 
}else{
	header('Location: main.php');
}
	include('footer.php');

?>