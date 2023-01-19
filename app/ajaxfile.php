<?php 

include "../config/config.php";

$request = 0;

if(isset($_POST['request'])){
	$request = $_POST['request'];
}

// Fetch hour list by date
if($request == 1){
	$dateselct = "'".$_POST['dateselct']."'";


				//hour in a day
				$tab = array();
				for($i=8;$i<=17;  $i++){
				  array_push ($tab, $i.":00",$i.":15",$i.":30",$i.":45");
				  $element = ['8:00','8:15','17:45'];
				  foreach ($element as &$value) {
					  unset($tab[array_search($value, $tab)]);
				  }			  
				  }

	
	$stmt = $conn->prepare("SELECT * FROM rdv WHERE rdv_date=$dateselct ORDER BY rdv_hour");

	$stmt->execute();
	$hourList = $stmt->fetchAll();
	if($stmt->rowCount() != 0) {


	//$tab=['08:30','08:40','08:50','09:00','09:10','09:20','09:30','09:40','09:50','10:00'];
	$response = array();
	foreach($hourList as $hour){
		
		$element = $hour['rdv_hour'];
   
			unset($tab[array_search($element, $tab)]);
			
	}

	foreach($tab as $ta){
						$response[] = array(
					"date" => $hour['rdv_date'],
					"hour" => $ta
				);
		
	  }

	} else {

		$response = array();
		foreach($tab as $t1){
			$response[] = array(
		"date" => $_POST['dateselct'],
		"hour" => $t1
	);

}
	}
	echo json_encode($response);
	exit;
}

