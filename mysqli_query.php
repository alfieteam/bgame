<?php
	$get_account = mysqli_query(connect(),"SELECT * FROM `users` WHERE `id` = '".$_SESSION['uid']."'")or die (mysqli_error());
	$account = mysqli_fetch_assoc($get_account);
	$get_build = mysqli_query(connect(),"SELECT * FROM `build` WHERE `build_owner` = '".$_SESSION['uid']."'")or die(mysqli_error());
	$build = mysqli_fetch_assoc($get_build);
	$get_stats = mysqli_query(connect(),"SELECT * FROM `stats` WHERE `id` = '".$_SESSION['uid']."'")or die(mysqli_error());
	$stats = mysqli_fetch_assoc($get_stats);
?>
