<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="kertc1.css">
	<title></title>

</head>
<body>
	<div id="container">
	<div id="formsearch">	
	<form>
		<button id="buts">Search</button>
	</form>
	</div>
	<table id="tab1">
    <tr> <th>SERVICE</th><th>DEPARTURE</th><th>ARRIVAL</th></tr>
    </table>
<?php
 $link = mysqli_connect("localhost", "root", "admin", "kertc");
  if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
  }
    $sqlb =  "SELECT * FROM `buses`";
    $resultb = mysqli_query($link, $sqlb);
    $countb = mysqli_num_rows($resultb);

    While($rowb = $resultb->fetch_assoc()){
    	$rou=intval($rowb[route]);
    	$sqlr =  "SELECT * FROM `route` WHERE routeno=$rou";
    	$resultr = mysqli_query($link, $sqlr);
    	$rowr = $resultr->fetch_assoc();
        
        While($rowr = $resultr->fetch_assoc()){
        	if($rowr[current]==$rowb[src])
        		{break;}
        }

		echo "<table id=\"tabg\">";
		echo "<tr><td>".$rowb[src]."-".$rowb[dest]."</td><td></td><td></td></tr>";
		echo "<tr><td id=\"typec\">".$rowb[type]."</td>";
		echo "<td>via</td><td>";
       	  While($rowr[next]!=$rowb[dest]){
       	  	if($i>11){echo "<br>";$i=0;}
          echo  $rowr[current].",";
          $rowr = $resultr->fetch_assoc();
          $i++;
          }
          echo  $rowr[current].",";
          $rowr = $resultr->fetch_assoc();
          echo  $rowr[current];
          $rowr = $resultr->fetch_assoc();
        echo "</td></tr>";
		echo "</table>";
      }
 ?>
</div>
</body>
</html>