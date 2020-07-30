<?php  
 
$link=mysqli_connect("localhost", "polarbear1022", "rladnfla7733!", "polarbear1022");  
if (!$link)
{  
    echo "MySQL 접속 에러 : ";
    echo mysqli_connect_error();
    exit();  
}  
 
mysqli_set_charset($link,"utf8"); 
 
 
$sql="select * from users";
 
$result=mysqli_query($link,$sql);
$data = array();   
if($result){  
    
    while($row=mysqli_fetch_array($result)){
        array_push($data, 
            array('id'=>$row[1]
        ));
    }
 
    header('Content-Type: application/json; charset=utf8');
$json = json_encode(array("webnautes"=>$data), JSON_PRETTY_PRINT+JSON_UNESCAPED_UNICODE);
echo $json;
 
}  
else{  
    echo "SQL error "; 
    echo mysqli_error($link);
} 
 
 
 
mysqli_close($link);  
   
?>
