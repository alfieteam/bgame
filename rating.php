<?php
	session_start();
	include('functions.php');
	if(isset($_SESSION['uid'])){
		include('mysqli_query.php');


	}
	include('header.php');
	if(isset($_SESSION['uid'])){
?>
<h3>Рейтинг(В разработке)</h3>
<hr>
<div id="#">
	<h4>Топ(В разработке)</h4>
	<div class="row">
		<div class="col-md-3"><b>ID</b></div>
		<div class="col-md-3"><b>$</b></div>
		<div class="col-md-3"><b></b></div>
	</div>
<?php

	$stats_rating = mysqli_query(connect(),"SELECT * FROM `stats` ORDER BY `cash` DESC")or die(mysqli_error());
	while($row = mysqli_fetch_assoc($stats_rating)){

?>
			<div class="row">
				<div class="col-md-3"><?php echo $row['id'];?></div>
				<div class="col-md-3">$<?php echo $row['cash'];?></div>
				<div class="col-md-3"></div>
			</div>
<?php
}//endWhile
?>


</div>
<?php 
}else{
	header('Location: main.php');
}
	include('footer.php');

?>