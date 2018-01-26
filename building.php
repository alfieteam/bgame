<?php
	session_start();
	include('functions.php');
	if(isset($_SESSION['uid'])){
		include('mysqli_query.php');


	}
	include('header.php');
	if(isset($_SESSION['uid'])){
		if(isset($_POST['start_building'])){
			build_create($_POST['build_type'],$_POST['build_country'],$_POST['building_cost'],$_POST['builders_amount']);	
		}
?>
<h3>Строительство(В разработке)</h3>
<hr>
<div id="realty_sell">
<h4>Построить(В разработке)</h4>
<form action="building.php" method="post">
	<div class="row">
		<div class="col-md-1"><b>Тип</b></div>
		<div class="col-md-2"><b>Адрес</b></div>
		<div class="col-md-2"><b>Строители</b></div>
		<div class="col-md-2"><b>Стоимость</b></div>
		<div class="col-md-1"><b>Срок</b></div>
		<div class="col-md-1"><b>Построить</b></div>
	</div>
	<div class="row">
		<div class="col-md-1">
			<select name="build_type">
				<option value="house">Дом</option>
				<option value="room">Квартира</option>
				<option value="office">Офис</option>
				<option value="hotel">Отель</option>
				<option value="shop">Магазин</option>
				<option value="restaurant">Ресторан</option>
				<option value="factory">Завод</option>
				<option value="warehouse">Склад</option>
				<option value="farm">Ферма</option>
				<option value="school">Школа</option>
				<option value="church">Церковь</option>
				<option value="hospital">Госпиталь</option>
				<option value="govbuilding">Гос.здание</option>
			</select>
		</div>
		<div class="col-md-2">
			<select name="build_country">
				<option value="ukraine">Украина(+20%)</option>
				<option value="china">Китай(+40%)</option>
				<option value="usa">США(+60%)</option>
				<option value="russia">Россия(+80%)</option>
				<option value="poland">Польша(+100%)</option>
			</select>
		</div>
		<div class="col-md-2">
			<select name="builders_amount">
				<option value="1">1</option>
				<option value="2">2</option>
				<option value="3">3</option>
				<option value="4">4</option>
				<option value="5">5</option>
			</select>
		</div>
		<script>
			function testFunction() {
				var x = document.getElementById("testInput").value;
				var build = document.getElementById("build").value;
				var country = document.getElementById("country").value;
				document.getElementById("worker_amount").innerHTML = "" + x;
				document.getElementById("building_time").innerHTML = "24" / x;
				document.getElementById("building_cost").innerHTML = build * country;
			}
		</script>
		<div class="col-md-2">
		<select name="building_cost">
				<option value="1000">1000 - Украина(0%)</option>
				<option value="1200">1200 - Китай(+20%)</option>
				<option value="1400">1400 - Польша(+40%)</option>
				<option value="1800">1800 - Россия(+80%)</option>
				<option value="2000">2000 - США(+100%)</option>
			</select>
		<p id="building_cost"></div>
		<div class="col-md-1"><b><p id="building_time">часов/чел</p></b></div>
		<div class="col-md-1"><input type="submit" class="btn btn-info" name="start_building" value="Строить"></div>
	</div>
</form>
<hr>
<h6>История(В разработке)</h6>
<div class="row">
	<div class="col-md-1"><b>ID_build</b></div>
	<div class="col-md-1"><b>Тип</b></div>
	<div class="col-md-2"><b>Начало</b></div>
	<div class="col-md-2"><b>Конец</b></div>
	<div class="col-md-2"><b>Строителей</b></div>
	<div class="col-md-2"><b>Статус</b></div>
</div>
<?php
	$building_list_status = mysqli_query(connect(),"SELECT * FROM `build_log` WHERE `build_owner` = '".$_SESSION['uid']."' ORDER BY `build_id` DESC")or die(mysqli_error());
	while($row = mysqli_fetch_assoc($building_list_status)){
?>
			<div class="row">
				<div class="col-md-1"><?php echo $row['build_id'];?></div>
				<div class="col-md-1"><?php echo $row['build_type'];?></div>
				<div class="col-md-2"><?php echo date( 'Y-m-d H:i:s', $row['building_start'] );?></div>
				<div class="col-md-2"><?php echo date( 'Y-m-d H:i:s', $row['building_end'] );?></div>
				<div class="col-md-2"><?php echo $row['builders_amount'];?></div>
				<div class="col-md-2"><?php echo $row['building_status'];?></div>
			</div>
<?php
}
?>

<?php

}// конец if(isset($_SESSION['uid']))

	include('footer.php');

?>