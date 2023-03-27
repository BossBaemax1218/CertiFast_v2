<?php 
    $query = "SELECT * FROM tblbrgy_info";
    $result = $conn->query($query);
	$row = $result->fetch_assoc();

	if($row){
		$province = $row['province'];
		$town	= $row['town'];
		$brgy 		= $row['brgy_name'];
		$number =  $row['number'];
		$city_logo 	= $row['city_logo'];
		$brgy_logo		= $row['brgy_logo'];
		$b_email		= $row['b_email'];
		$db_img		= $row['image'];
	}

	$pos_q = "SELECT * FROM tblposition";
    $pos_r = $conn->query($pos_q);

    $position = array();
	while($row = $pos_r->fetch_assoc()){
		$position[] = $row; 
	}
    
?>