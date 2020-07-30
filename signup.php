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
    $uname = $_POST["uname"];
    $ulevel = $_POST["ulevel"];
    $uexp = $_POST["uexp"];

    $sql = "INSERT INTO users VALUES ('$uid', '$uname', '$ulevel', '$uexp')";
    $result = mysqli_query($link, $sql);
    
    $response = array();
    $response["success"] = true;

    echo json_encode($response);



?>


