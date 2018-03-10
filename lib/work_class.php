<?php
		class Work {
		
			public function set_work_time($work_id,$work_time){
				$query = mysqli_query(connect(),"UPDATE `workv1` 
												SET `work_time` = '".$work_time."' 
												WHERE `id` = '".$work_id."'") 
												or die(mysqli_error());
			}

			public function set_work_pay($work_id,$work_pay){
				$query = mysqli_query(connect(),"UPDATE `workv1` 
												SET `work_pay` = '".$work_pay."' 
												WHERE `id` = '".$work_id."'") 
												or die(mysqli_error());
			}

			public function set_work_name($work_id,$work_name){
				$query = mysqli_query(connect(),"UPDATE `workv1` 
												SET `workname` = '".$work_name."' 
												WHERE `id` = '".$work_id."'") 
												or die(mysqli_error());
			}

		}


?>