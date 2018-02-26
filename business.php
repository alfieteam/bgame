<?php
	session_start();
	include('functions.php');
	if(isset($_SESSION['uid'])){
		include('mysqli_query.php');
	}
	include('header.php');
	if(isset($_SESSION['uid'])){
?>
<h3>Бизнес(В разработке)</h3>
<hr>
<div id="realty_sell">
<h4>Выбирите направление(Разработке)</h4>
<h6>Ваш опыт: <?php echo $stats['business_level'];?></h6>
	<div class="row">
		<div class="col-md-1"><b>ID</b></div>
		<div class="col-md-1"><b>Тип</b></div>
		<div class="col-md-1"><b>Здание</b></div>
		<div class="col-md-1"><b>Размер</b></div>
		<div class="col-md-1"><b>Страна</b></div>
		<div class="col-md-1"><b>Работники</b></div>
		<div class="col-md-1"><b>Стоимость</b></div>
		<div class="col-md-1"><b>Опыт</b></div>
		<div class="col-md-1"><b>...</b></div>
		<div class="col-md-1"><b>Помещения</b></div>
	</div>
<?php
	$business_type_query = mysqli_query(connect(),"SELECT * FROM `business` ORDER BY `level` ASC")or die(mysqli_error());
	while($row = mysqli_fetch_assoc($business_type_query)){  
		if($stats['business_level'] >= $row['level']){
?>
		<form action="business.php" method="post">
			<div class="row">
				<div class="col-md-1"><?php echo $row['id'];?></div>
				<div class="col-md-1"><?php echo $row['type'];?></div>
				<div class="col-md-1"><?php echo $row['build_type'];?></div>
				<div class="col-md-1"><?php echo $row['build_size'];?></div>
				<div class="col-md-1"><?php echo $row['build_country'];?></div>
				<div class="col-md-1"><?php echo $row['worker'];?></div>
				<div class="col-md-1">$<?php echo $row['cost'];?></div>
				<div class="col-md-1"><?php echo $row['level'];?></div>
				<div class="col-md-1">
				<input type="submit" class="btn btn-info" name="sell" value="Выбрать">
				</div>
				<div class="col-md-1">
				<select>
					<?php 
						select_business_build($row['build_type'],$row['build_size'],$row['build_country']);
						
					?>
					</select>
				</div>
			</div>
		</form>
<?php	
		}//конец if
		elseif($stats['business_level'] < $row['level']){
?>
<form action="business.php" method="post">
			<div class="row">
				<div class="col-md-1"><?php echo $row['id'];?></div>
				<div class="col-md-1"><?php echo $row['type'];?></div>
				<div class="col-md-1"><?php echo $row['build_type'];?></div>
				<div class="col-md-1"><?php echo $row['build_size'];?></div>
				<div class="col-md-1"><?php echo $row['build_country'];?></div>
				<div class="col-md-1"><?php echo $row['worker'];?></div>
				<div class="col-md-1">$<?php echo $row['cost'];?></div>
				<div class="col-md-1"><?php echo $row['level'];?></div>
				<div class="col-md-1">
					<input type="submit" class="btn btn-warning" disabled value="Нет опыта">
				</div>
				<div class="col-md-1">
				<select>
					<?php 
						select_business_build($row['build_type'],$row['build_size'],$row['build_country']);
						
					?>
					</select>
				</div>
			</div>
		</form>
<?php
		}//конец elseif
	}//конец первого while
?>
</div>
<hr>
<?php 
}else{
	header('Location: main.php');
}
	include('footer.php');

?>