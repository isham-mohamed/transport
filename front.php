<?php  
  session_start();
	$username = $_SESSION['username'];
	if($username==NULL)
   {header("location: login.php");}

	$link = mysqli_connect("localhost", "root", "admin", "kertc");
  if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
  }
    $sql =  "SELECT * FROM `buses`";
    $result = mysqli_query($link, $sql);
    $count = mysqli_num_rows($result);
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="kertc.css">
	<title>
	</title>
</head>
<body>
	<div>
		<header></header>
	</div>
 <div id="wrap1"> 
	<div id="tableb">
		<table id="tab">
    <tr> <th>Busno</th><th>Src</th><th>Dest</th><th>last</th><th>rev</th> </tr>
    <form>
    <?php
		While($row = $result->fetch_assoc()){
    	$l = $row[busno]."l";
    	echo "<tr><td>".$row[busno]."</td>";
      echo     "<td>".$row[src]."</td>";
      echo     "<td>".$row[dest]."</td>";
      echo     "<td id=$l>".$row[last]."</td>";
      echo     "<td><input class=\"bt\" type=\"button\" id=$row[busno] value=\" \" onclick=\"rev('$row[busno]','$username','$row[last]')\"></td></tr>";
      }
    	?>
    </form>
      </table>
    	<?php 

    if(isset($_POST['busno'])&&isset($_POST['type'])&&$_POST['busno']!=""&& isset($_POST['dest'])&&$_POST['dest']!="")
  {
    $busno = $_POST['busno'];
    $src = strtoupper($username);
    $dest = strtoupper($_POST['dest']);
    $last = $src;
    $type = $_POST['type'];
    $route = $_POST['route'];
    $route = intval($route);
    $sql =  "INSERT INTO `buses` VALUES('$busno','$src','$dest','$last','$type','$route')";
    $result = mysqli_query($link, $sql);
    $count = mysqli_num_rows($result);
    header("location: front.php");
  }
    	 ?>
    </div>
    </div>
    
    <div id="wrap3">
  
    <div id="tabr" >
    <table>  
    <tr> <th>no</th><th >via</th></tr>  
    <?php
     
     $link = mysqli_connect("localhost", "root", "admin", "kertc");
     if($link === false){
     die("ERROR: Could not connect. " . mysqli_connect_error());
     }
     $sql =  "SELECT * FROM `route`";
     $result = mysqli_query($link, $sql);
     $count = mysqli_num_rows($result);
     While($row = $result->fetch_assoc()){
      $rou=$row[routeno];
      echo "<tr><td> ".$rou." </td>";
      echo  "<td> ";
        While($row[next]!="ADMIN"){
         echo  $row[current].",";
         $row = $result->fetch_assoc();
        }
        echo  $row[current];
       echo  "</td></tr>";
      }
     ?>
   </table>
   </div>

  	<div class="form-control" >
    <form id="form" method="POST">
  	<dl style="margin-top: 0px;" >
  		<dt class="name" >Bus no</dt>
	    <dt>
	    <input id="busno" class="inp" type="text" placeholder="Enter busno" name="busno" >
	    </dt>	
	</dl>
  <dl style="margin-top: 0px;" >
      <dt class="name">Destination</dt>
      <dt>
      <input id="dest" class="inp" type="text" placeholder="To" name="dest">
      </dt>
  </dl>
  <dl style="margin-top: 0px;" >
      <dt class="name">Route no</dt>
      <dt>
      <input id="route" class="inp" type="text" placeholder="Route" name="route">
      </dt>
  </dl>
  <dl style="margin-top: 0px;" >
      <dt class="name">Type</dt>
      <dt>
      <select class="inp" id="type" name="type">
        <option value="Super fast">Super Fast</option>
        <option value="Fast passenger">Fast Passenger</option>
        <option value="Ordinary">Ordinary</option>
      </select>
      </dt>
  </dl>
	<dl style="margin-top: 0px;" >
		<dt>
		<button id="but" name="addbus">Add Bus</button>
      </dt>
	</dl>
    </form>
    </div>
</div>
<div id="wrap2">
    <div>
      <dl style="margin: 0px;" >
    <dt>
    <button id="butlo" class="butanl" name="logout" onclick="logout()">Logout</button>
      </dt>
  </dl>
    </div>
</div>
<script type="text/javascript" src="kertc.js">
    </script>
</body>
</html>