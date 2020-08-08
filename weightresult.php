<?php
    $link=mysqli_connect("localhost", "polarbear1022", "rladnfla7733!", "polarbear1022"); 
    if (!$link)
    {  
        echo "MySQL 접속 에러 : ";
        echo mysqli_connect_error();
        exit();  
    }  
    mysqli_set_charset($link,"utf8"); 

    $uid = $_POST["uid"];
    $weight = $_POST["weight"];
    $point = $_POST["point"];
	$wdate = date("Y-m-d", time());


    $sql = "INSERT INTO weightsandpoints VALUES ('$uid', '$wdate', $weight, $point)";
    $result = mysqli_query($link, $sql);

    
    $sql2 = "UPDATE users SET user_point=user_point+$point WHERE uid='$uid'";
    $result2 = mysqli_query($link, $sql2);

?>