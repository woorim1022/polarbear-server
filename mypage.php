<?php

	$link=mysqli_connect("localhost", "polarbear1022", "rladnfla7733!", "polarbear1022");
	mysqli_set_charset($link,"utf8");
	
	$uid=$_POST["uid"];
	
	$sql="SELECT SUM(apple) AS total1, SUM(fish) AS total2, SUM(meat) AS total3,
		   SUM(ice) AS total4 FROM buying_list WHERE uid='$uid' && uid=mypage_id GROUP BY mypage_id";
	$result= mysqli_query($link, $sql);	  
	
	$response =array():
	
	if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)) {
            $response["total1"]=$row["total1"];
            $response["total2"]=$row["total2"];
            $response["total3"]=$row["total3"];
            $response["total4"]=$row["total4"];
        }
    }
    else{
        echo "MySQL failed!<br/>"; 
    }

   
    echo json_encode($response);

?>
