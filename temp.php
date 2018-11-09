<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<?php
$link = mysqli_connect("localhost", "root", "admin", "kertc");
  if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
  }
    $sql =  "SELECT * FROM `users1`";
    $result = mysqli_query($link, $sql);
    $count = mysqli_num_rows($result);
    While($row = $result->fetch_assoc()){
    	$username=$row[username];
    	$name=$row[name];
    $password = strtolower($row[password]);  
		$password=sha1($password);
		$sql1="INSERT INTO `users` VALUES('$username','$password','$name')";
		$result1 = mysqli_query($link, $sql1);
    	$count1 = mysqli_num_rows($result);
    	if($result1){
    		echo "ya";
    	}
      }
      echo"done";
?>
</body>
</html>