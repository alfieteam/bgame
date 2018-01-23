<?php
//	define("DB_HOST","db2.ho.ua");
//	define("DB_USER","bizgame");
//	define("DB_PASS","11091991");
//	define("DB_NAME","bizgame");
	define("DB_HOST","localhost");
	define("DB_USER","root");
	define("DB_PASS","");
	define("DB_NAME","bgame");

	function connect(){
		$link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME) or die(mysqli_error());
		return $link;
	}


/**
 * Функции для работы с недвижимостью
 *
 *
 */
	function build_create(){

	}
	function build_buy($build_id,$seller_id,$buyer_id,$price){

		//Получаем данные о деньгах покупателя и продавца
		$get_stats_build_buyer = mysqli_query(connect(),"SELECT * FROM `stats` WHERE `id` = '".$buyer_id."'")or die(mysqli_error());
		$stats_build_buyer = mysqli_fetch_assoc($get_stats_build_buyer);
		$get_stats_build_seller = mysqli_query(connect(),"SELECT * FROM `stats` WHERE `id` = '".$seller_id."'")or die(mysqli_error());
		$stats_build_seller = mysqli_fetch_assoc($get_stats_build_seller);
		//проверить достаточно ли у покупателя денег на покупку(bayer->cash >= $price)
		if($stats_build_buyer['cash'] >= $price){
			//Высчитываем остаток денег покупателя
			$b_cash = $stats_build_buyer['cash'] - $price;
			//Отбераем деньги у покупателя
			$query1 = mysqli_query(connect(),"UPDATE `stats` SET `cash` = '".$b_cash."' WHERE `id` = '".$buyer_id."'")or die(mysqli_error());
			//Высчитываем остаток денег продавца(было + стоимость здания)
			$s_cash = $stats_build_seller['cash'] + $price;
			//Передаём деньги продавцу
			$query2 = mysqli_query(connect(),"UPDATE `stats` SET `cash` = '".$s_cash."' WHERE `id` = '".$seller_id."'")or die(mysqli_error());
			//Меняем владельца здания, онулируем цену продажи, меняем себестоимость на цену покупки, снимаем с продажи.
			$query3 = mysqli_query(connect(),"UPDATE `build` SET `build_owner` = '".$buyer_id."', 
																 `build_in_sell` = 'no', 
																 `build_cost` = '".$price."',
																 `build_sell_cost` = 0
																  WHERE `build_id` = '".$build_id."'")or die(mysqli_error());
			header('Location: realty.php');

		}elseif($stats_build_buyer['cash'] < $price){
			echo "<br><b>Проверку на деньги не прошел!</b>";
		}else{
			echo "Что то пошло не так в функции build_buy";
		}


	}
	function build_sell($build_id,$build_sell_cost){
		//устанавливаем build_sell_cost c 0 до суммы указаной в поле,устанавливаем build_in_sell = 'yes'
		$query = mysqli_query(connect(),"UPDATE `build` SET `build_sell_cost` = '".$build_sell_cost."',
															 `build_in_sell` = 'yes' 
															  WHERE `build_id` = '".$build_id."'")or die(mysqli_error());
		header('Location: realty.php');

	}
	function build_sell_cancel($build_id){
		//обнуляем sell_cost и снимаем с продажи
		$query = mysqli_query(connect(),"UPDATE `build` SET `build_sell_cost` = '0',
															`build_in_sell` = 'no'
															 WHERE `build_id` = '".$build_id."'")or die(mysqli_error());
		header('Location: realty.php');
	}


/**
 * Функции для работы с аккаунтом
 *
 *
 */
?>