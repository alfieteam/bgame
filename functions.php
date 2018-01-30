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
 * Функции для работы с Работами(трудоустройством)
 *
 *
 */
	function workv1($work_id,$work_pay,$worker_id){
		$query = mysqli_query(connect(),"SELECT * FROM `work_log` WHERE `user_id` = '".$worker_id."' AND `work_status` = 'in_work'")or die(mysqli_error());
		if(mysqli_num_rows($query) > 1){
			echo "Вы уже устроены на работу!";
		}else{
			//Устанавливаем время работы
			$time_end = time() + 60;
			$query1 = mysqli_query(connect(),"INSERT INTO `work_log` (`work_id`,`user_id`,`work_start`,`work_end`,`work_pay`,`work_status`) 
											VALUES ('".$work_id."','".$worker_id."','".time()."','".$time_end."','".$work_pay."','in_work')")
											or die(mysqli_error());
			header('Location: work.php');
		}
	}


	//Проверка о выполнении работы
	function workv1_check($worker_id){
					//Запрос к логу работы
					$query = mysqli_query(connect(),"SELECT * FROM `work_log` WHERE `user_id` = '".$worker_id."' AND `work_status` = 'in_work'")or die(mysqli_error());
					//делаем массив из логов
					$query_arr = mysqli_fetch_assoc($query);
					//Проверяем есть ли не выполненая работа.
					if(isset($query_arr['work_end'])){
						//Проверяем закончилось ли работа
						if(time() >= $query_arr['work_end']){
							$query1 = mysqli_query(connect(),"UPDATE `work_log` SET `work_status` = 'completed' WHERE `user_id` = '".$worker_id."'") or die(mysqli_error());
							$get_stats_for_workv1 = mysqli_query(connect(),"SELECT * FROM `stats` WHERE `id` = '".$_SESSION['uid']."'")or die(mysqli_error());
							$stats_for_workv1 = mysqli_fetch_assoc($get_stats_for_workv1);
							$cash_update_work = $stats_for_workv1['cash'] + $query_arr['work_pay'];
							$query2 = mysqli_query(connect(),"UPDATE `stats` SET `cash` = '".$cash_update_work."' WHERE `id` = '".$worker_id."'") or die(mysqli_error());
							//header('Location: work.php');//Нужно сделать так что бы оно не перекидывало никуда, но и что бы нельзя было повторно отправить запрос
						}
					}
				}



/**
 * Функции для работы с недвижимостью
 *
 *
 */
	function build_create($build_type,$build_country,$build_size,$builders_amount){
		//Проверка на деньги, изьятие денег за постройку....................................................................................................

		$type_cost = array("house" => '1000',"room" => '1100', "office" => '1200', "hotel" => '1100',
						   "shop" => '1200', "restaurant" => '2000', "factory" => '1900',
						   "warehouse" => '700', "farm" => '350', "school" => '1700',
						   "church" => '4000', "hospital" => '5600', "govbuilding" => '3000');
		$build_country_cost = array("ukraine" => 1.20, "china" => 1.05, "usa" => 2.30, "russia" => 1.25, "poland" => 1.35);
		
		//$build_cost = $build_type_cost*$build_country_cost['$build_country']*$build_size;
		$build_cost = $type_cost[''.$build_type.''] * $build_country_cost[''.$build_country.''] * $build_size;
		$get_stats_build_create = mysqli_query(connect(),"SELECT * FROM `stats` WHERE `id` = '".$_SESSION['uid']."'")or die(mysqli_error());
		$stats_build_create = mysqli_fetch_assoc($get_stats_build_create);
		if($stats_build_create['cash'] >= $build_cost && $stats_build_create['builders_free'] >= $builders_amount){

			//Создаём здание
			$query1 = mysqli_query(connect(),"INSERT INTO `build` (`build_type`,`build_country`,`build_size`,`build_cost`,`build_owner`,`build_status`) 
											  VALUES ('".$build_type."','".$build_country."','".$build_size."','".$build_cost."','".$_SESSION['uid']."','in_construction')")
											  or die(mysqli_error());
			$building_speed = 60 / $builders_amount;
			$building_time = time() + $building_speed;
			//Создаём log для дальнейшего перевода в недвижимость
			$query2 = mysqli_query(connect(),"INSERT INTO `build_log` (`build_type`,`build_country`,`build_size`,`build_owner`,`builders_amount`,`building_start`,`building_end`,`building_status`) 
											VALUES ('".$build_type."','".$build_country."','".$build_size."','".$_SESSION['uid']."','".$builders_amount."','".time()."','".$building_time."','in_construction')")or die(mysqli_error());
			//Изымаем деньги и строителей в резерв
			$cash_result = $stats_build_create['cash'] - $build_cost;
			$builders_free_result = $stats_build_create['builders_free'] - $builders_amount;
			$query3 = mysqli_query(connect(),"UPDATE `stats` 
											  SET `cash` = '".$cash_result."',
											  `builders_free` = '".$builders_free_result."',
											  `builders_in_use` = '".$builders_amount."'
											  WHERE `id` = '".$_SESSION['uid']."'")or die(mysqli_error());
			//header('Location: building.php');

		}elseif($stats_build_create['cash'] < $build_cost){
			echo "Бабок НЕ достаточно";
		}elseif($stats_build_create['builders_free'] < $builders_amount){
			echo "Недостаточно строителей!";
		}

	}

	function build_check(){
		$build_check_query = mysqli_query(connect(),"SELECT * FROM `build_log` WHERE `building_status` = 'in_construction' AND `build_owner` = '".$_SESSION['uid']."'")or die(mysqli_error());
		while($row = mysqli_fetch_assoc($build_check_query)){
			if(time() > $row['building_end']){
				//Необходимо дописать проверку на builder'ов -  освобождение............................................
				$build_check_update_log = mysqli_query(connect(),"UPDATE `build_log` 
															  SET `building_status` = 'complite'
															  WHERE `build_id` = '".$row['build_id']."'")or die(mysqli_error());
				$build_check_update = mysqli_query(connect(),"UPDATE `build`
															  SET `build_status` = 'complite',
															      `build_in_sell` = 'no'
															  WHERE `build_id` = '".$row['build_id']."'")or die(mysqli_error());

				//Возвращаем строителей
				$get_stats = mysqli_query(connect(),"SELECT * FROM `stats` WHERE `id` = '".$_SESSION['uid']."'")or die(mysqli_error());
				$stats = mysqli_fetch_assoc($get_stats);
				//сумируем освобождённых строителей и свободных
				$builders_free = $stats['builders_free'] + $row['builders_amount'];
				$builders_in_use = $stats['builders_in_use'] - $row['builders_amount'];
				//
				$query1 = mysqli_query(connect(),"UPDATE `stats` 
											  SET `builders_free` = '".$builders_free."',
											  `builders_in_use` = '".$builders_in_use."'
											  WHERE `id` = '".$_SESSION['uid']."'")or die(mysqli_error());
				header('Location: building.php');
			}
		}

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