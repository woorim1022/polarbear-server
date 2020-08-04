<?php 
    $link=mysqli_connect("localhost", "polarbear1022", "rladnfla7733!", "polarbear1022"); 

    $uid = $_POST["uid"];
	$wdate = date("Y-m-d", time());

    $sql = "SELECT * FROM weights WHERE wid='test' AND wdate='$wdate'";
    $result = mysqli_query($link, $sql);


    $response = array();
    
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)) {
            $response["weight"]=$row["weight"];
            $response["date"]=$wdate;
        }
    }
    else{
        echo "MySQL failed!<br/>"; 
    }

   
    echo json_encode($response);



?>