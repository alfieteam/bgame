<?php
	session_start();
	include('functions.php');
	if(isset($_SESSION['uid'])){
		include('mysqli_query.php');
	}
	include('header.php');
	if(isset($_SESSION['uid'])){
?>


<h2 style="text-align: center;">Главная</h2>
Ваш ID: <b><?php echo $account['id'];?></b>
<br>
Никнейм: <b><?php echo $account['username'];?></b>
<hr>
<div id="realty">
	<h5 style="text-align: center; ">Недвижемость (в разработке)</h5>
	<div class="row">
		<div class="col-md-6">Тип: Дом(в разработке)</div>
		<div class="col-md-6">Доход: +0%/день(в разработке)</div>
	</div>
	<div class="row">
		<div class="col-md-6">Тип: Квартира(в разработке)</div>
		<div class="col-md-6">Доход: +0%/день(в разработке)</div>
	</div>
</div>
<hr>
<div id="busines">
	<h5 style="text-align: center;">Бизнес (в разработке)</h5>
	<div class="row">
		<div class="col-md-4">Универсам "Копейка"(в разработке)</div>
		<div class="col-md-4">Доход: $0/день(в разработке)</div>
		<div class="col-md-4">ID: 0 (в разработке)</div>
	</div>
	<div class="row">
		<div class="col-md-4">Тип: Завод "Копейка"(в разработке)</div>
		<div class="col-md-4">Тип: Доход: $0/день(в разработке)</div>
		<div class="col-md-4">ID: 0 (в разработке)</div>
	</div>
</div>
<hr>
<div id="working">
	<h5 style="text-align: center;">Работа (в разработке)</h5>
	<div class="row">
		<div class="col-md-4">Опыт: Дней/часов/колустройств на работу </div>
		<div class="col-md-4">Доход: $0/день(в разработке)</div>
		<div class="col-md-4">Фирма: DiKate Agency(в разработке)</div>
		<div class="col-md-4">Энергия: 0/0 (в разработке)</div>
	</div>
</div>


<?php }else{ 
	//Видно неавторизированным пользователям
	echo "<h3>Новости</h3><hr>";
	get_news();

}
	include('footer.php');
?>