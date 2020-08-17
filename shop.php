<?php 
    $link=mysqli_connect("localhost", "polarbear1022", "rladnfla7733!", "polarbear1022");

    $sql = "SELECT * FROM products";
    $result = mysqli_query($link, $sql);

    
    if(mysqli_num_rows($result) > 0)
    {
	$response = array();
        	
	while($row = mysqli_fetch_assoc($result))
	{
          		extract($row);
	
           		array_push($response, 
	    		array('pid' => $pid, 
			'pname' => $pname, 
			'buyerid' => $buyerid,
			'price' => $price
          		));
        }
    }
    else{
        echo "MySQL failed!<br/>"; 
    }

    header('Content-Type: application/json; charset=utf8');
    $json = json_encode(array("donate list"=>$response), JSON_PRETTY_PRINT+JSON_UNESCAPED_UNICODE);
    echo $json;



?>
	
