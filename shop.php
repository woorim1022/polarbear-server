<?php
	$link=mysqli_connect("localhost", "polarbear1022", "rladnfla7733!", "polarbear1022");
	mysqli_set_charset($link,"utf8");
	
	$uid=$_POST["uid"];
	
	
	if(isset($_POST["pname"]) && $_POST["pname"]=="apple"){
		$pname=$_POST["pname"];
		if(isset($_POST["user_total"])){
			$user_total=$_POST["user_total"];
		}
		else{
			echo "구입불가< br/>";
		}
		if(($user_total-50)>0){
			mysqli_query($link, "UPDATE users SET user_total=user_total - 50 where uid='$uid");
			mysqli_query($link, "INSERT INTO buying_list VALUES ('$uid', '1', '0', '0','0')");
			echo "구입완료<br/>";		
		}
		else{
			echo "포인트가 부족합니다.<br/>";
		}
	}
	elseif(isset($_POST["pname"]) && $_POST["pname"]=="fish"){
		$pname=$_POST["pname"];
		if(isset($_POST["user_total"])){
			$user_total=$_POST["user_total"];
		}
		else{
			echo "구입불가< br/>";
		}
		if(($user_total-100)>0){
			mysqli_query($link, "UPDATE users SET user_total=user_total - 100 where uid='$uid");
			mysqli_query($link, "INSERT INTO buying_list VALUES ('$uid', '0', '1', '0','0')");
			echo "구입완료<br/>";		
		}
		else{
			echo "포인트가 부족합니다.<br/>";
		}
	}
	elseif(isset($_POST["pname"]) && $_POST["pname"]=="meat"){
		$pname=$_POST["pname"];
		if(isset($_POST["user_total"])){
			$user_total=$_POST["user_total"];
		}
		else{
			echo "구입불가< br/>";
		}
		if(($user_total-150)>0){
			mysqli_query($link, "UPDATE users SET user_total=user_total - 150 where uid='$uid");
			mysqli_query($link, "INSERT INTO buying_list VALUES ('$uid', '0', '0', '1','0')");
			echo "구입완료<br/>";		
		}
		else{
			echo "포인트가 부족합니다.<br/>";
		}
	}
	elseif(isset($_POST["pname"]) && $_POST["pname"]=="apple"){
		$pname=$_POST["pname"];
		if(isset($_POST["user_total"])){
			$user_total=$_POST["user_total"];
		}
		else{
			echo "구입불가< br/>";
		}
		if(($user_total-200)>0){
			mysqli_query($link, "UPDATE users SET user_total=user_total - 200 where uid='$uid");
			mysqli_query($link, "INSERT INTO buying_list VALUES ('$uid', '0', '0', '0','1')");
			echo "구입완료<br/>";		
		}
		else{
			echo "포인트가 부족합니다.<br/>";
		}
	}
	else{
		echo "구입불가< br/>";
	}
	
?>
	
