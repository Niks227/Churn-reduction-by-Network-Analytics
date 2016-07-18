<?php 
	include 'sqli_connect.php';
		
		
	 function csr($no)
 		{		
 			include 'sqli_connect.php';	
			$totalRecords = 0;
			$callSuccessRecords = 0;
			$query = "SELECT `Mobile No`, `Cause_Code`, `Duration` FROM `table 1` WHERE `Mobile No` = '$no' " ;
			$result = $con->query($query);
			if($result) // will return true if succefull else it will return false
			{		
				if($result->num_rows>=1){
					while ($row = $result->fetch_assoc()) {
						$totalRecords++;
						if($row['Cause_Code'] == 0){
							$callSuccessRecords++;
						}
					} 

	       				
	    		}
			
						
 			}

 	//		echo "Successfull Calls- ".$callSuccessRecords. "<br> ";
 	//		echo "Total Calls- " . $totalRecords. " <br>";
 	//		echo "CALL SUCCESS RATE- " . $callSuccessRecords/$totalRecords . "<br>";
 			$csr =$callSuccessRecords/$totalRecords;
 			return $csr;

 		}

 		function dsr($no)
 		{
	 		include 'sqli_connect.php';	

	 		$totalDataRecords = 0;
			$dataSuccessRecords = 0;
			$query = "SELECT `Mobile no`, `EVENT_DURATION`, `Cause Code`, `FLAG_3G_2G`, `TOTAL_VOLUME` FROM `table 2` WHERE `Mobile no` = ' $no' ";
			$result = $con->query($query);
			if($result) // will return true if succefull else it will return false
			{		
				if($result->num_rows>=1){
					while ($row = $result->fetch_assoc()) {
						$totalDataRecords++;
						if($row['Cause Code'] == 0){
							$dataSuccessRecords++;
						}
					} 

	       				
	    		}
			
						
 			}
 	//		echo "Successfull Data Records- ".$dataSuccessRecords. "<br> ";
 	//		echo "Total Data Records- " . $totalDataRecords. " <br>";
 	//		echo "Data SUCCESS RATE- " . $dataSuccessRecords/$totalDataRecords . "<br>";
 			$dsr = $dataSuccessRecords/$totalDataRecords;
 			return $dsr;

 		}

 		function rate2g($no)
 		{
 			include 'sqli_connect.php';
 			$eventDuration2G = 0;
			$totalDuration   = 0;
			$limit2G = 1000;
			$query = "SELECT `Mobile no`, `EVENT_DURATION`, `Cause Code`, `FLAG_3G_2G`, `TOTAL_VOLUME` FROM `table 2` WHERE `Mobile no` = ' $no' ";
			$result = $con->query($query);
			if($result) // will return true if succefull else it will return false
			{		
				if($result->num_rows>=1){
					while ($row = $result->fetch_assoc()) {
						$avgSpeed = $row['TOTAL_VOLUME']/$row['EVENT_DURATION'];   
					//	echo "<br> avgSpeed   ".$avgSpeed;
						if($avgSpeed < $limit2G){
							$eventDuration2G += $row['EVENT_DURATION'];
						}
						$totalDuration += $row['EVENT_DURATION'];
					} 

	       				
	    		}
			
						
 			}
// 			echo "2G Event Duration - ".$eventDuration2G. "<br> ";
 //			echo "Total Duration - " . $totalDuration. " <br>";
 	//		echo "2G Rate- " . $eventDuration2G/$totalDuration . "<br>";
 			$rate2g = $eventDuration2G/$totalDuration ;
 			return $rate2g;

 		}



 			$count =0;
			$query1 = "SELECT distinct `Mobile No` FROM `table 1`  " ;
			$result1 = $con->query($query1);
			if($result1) // will return true if succefull else it will return false
			{		
				if($result1->num_rows>=1){
					while ($row1 = $result1->fetch_assoc()) {
						$no = $row1['Mobile No'];
				//		echo "<br>".$count++. "<Br>";
						$csr    = csr($no);
						$dsr    = dsr($no);
						$rate2g = rate2g($no);
				//		echo $csr." ";
				//		echo $dsr." ";
				//		echo $rate2g." ";

						$query2 = "INSERT INTO `kpis`(`mobile no`, `csr`, `dsr`, `2grate`) VALUES ('$no','$csr','$dsr','$rate2g')";
						$result2 = $con->query($query2);


					}


	       				
	    		}
			
						
 			}


 
 
		echo "GENERATED";
 ?>