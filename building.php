<?php
	session_start();
	include('functions.php');
	if(isset($_SESSION['uid'])){
		include('mysqli_query.php');


	}
	include('header.php');
	if(isset($_SESSION['uid'])){
?>
<h3>Строительство(В разработке)</h3>
<hr>
<div id="realty_sell">
<h4>Построить(В разработке)</h4>
	<div class="row">
		<div class="col-md-1"><b>Тип</b></div>
		<div class="col-md-1"><b>Адрес</b></div>
		<div class="col-md-2"><b>Строители</b></div>
		<div class="col-md-2"><b>Стоимость</b></div>
		<div class="col-md-1"><b>Срок</b></div>
		<div class="col-md-1"><b>Построить</b></div>
	</div>
	<div class="row">
		<div class="col-md-1">
			<select>
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
			<input type="range" id="build" min="1" max="10" value="0" oninput="testFunction()">

		</div>
		<div class="col-md-1">
			<select>
				<option value="ukraine">Украина(+20%)</option>
				<option value="china">Китай(+40%)</option>
				<option value="usa">США(+60%)</option>
				<option value="russia">Россия(+80%)</option>
				<option value="poland">Польша(+100%)</option>
			</select>
			<input type="range" id="country" min="1" max="2" step="0.20" value="0" oninput="testFunction()">

		</div>
		<div class="col-md-2">
				<input type="range" id="testInput" min="1" max="10" value="0" oninput="testFunction()">
			<b><p id="worker_amount"></p></b>

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
		<div class="col-md-2"><p id="building_cost">Здание+Земля=Цена</p></div>
		<div class="col-md-1"><b><p id="building_time">часов/чел</p></b></div>
		<div class="col-md-1"><input type="submit" class="btn btn-info" value="Строить"></div>
	</div>
<?php

}// конец if(isset($_SESSION['uid']))

	include('footer.php');

?>