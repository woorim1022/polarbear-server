<?php 
header("Content-Type: text/html;charset=UTF-8"); 

$host = 'localhost'; 
$user = '아이디'; 
$pw = '비번'; 
$dbName = 'db명'; 
$mysqli = new mysqli($host, $user, $pw, $dbName); 

	if($mysqli){ 
		echo "MySQL successfully connected!<br/>"; 
		
		$weight = (float)$_POST['weight']; 
		 
		echo "<br/>weight = $weight"; 
		
		//이 부분을 각자 테스트 서버에 맞게 수정하시면 됩니다 
		$query = "INSERT INTO weight (weight) VALUES ('$weight')"; 
		mysqli_query($mysqli,$query); 
		
		echo "</br>success!!"; 
	} 
	else{ 
		echo "MySQL could not be connected"; 
	} 

mysqli_close($mysqli); 
?>
