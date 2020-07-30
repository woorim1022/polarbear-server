<?php 
    $link=mysqli_connect("localhost", "polarbear1022", "rladnfla7733!", "polarbear1022"); 

    $uid = $_POST["uid"];

    $sql = "SELECT uid FROM users WHERE uid='$uid'";
    $result = mysqli_query($link, $sql);


    $response = array();
    $response["success"] = true;
    
    if(mysqli_num_rows($result) > 0){
        $response["success"]=false;
        $response["uid"]=$uid;
    }
   
    echo json_encode($response);



?>