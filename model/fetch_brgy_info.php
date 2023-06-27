<?php 
    $query = "SELECT * FROM tblbrgy_info";
    $result = $conn->query($query);
	$row = $result->fetch_assoc();

	if($row){
		$province = $row['province_name'];
		$town	= $row['town_name'];
		$brgy 		= $row['brgy_name'];
		$brgy_add 		= $row['brgy_address'];
		$number =  $row['contact_number'];
		$city_logo 	= $row['city_logo'];
		$brgy_logo		= $row['brgy_logo'];
		$b_email		= $row['brgy_email'];
		$db_img		= $row['dashboardphoto'];
	}

	$pos_q = "SELECT * FROM tblposition";
    $pos_r = $conn->query($pos_q);

    $position = array();
	while($row = $pos_r->fetch_assoc()){
		$position[] = $row; 
	}
    
?>