<?php
session_start();
require_once 'connection.php'; // подключаем скрипт
 
$link = mysqli_connect($servername, $username, $password, $database) 
    or die("Ошибка " . mysqli_error($link)); 
     
$query ="SELECT * FROM users";
$query_role ="SELECT * FROM roles";
 
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
$result_role = mysqli_query($link, $query_role) or die("Ошибка " . mysqli_error($link));  
?>

<!doctype html>
<html>
<body>
	   <link rel="stylesheet" href="nestyles.css">
	   <link rel="stylesheet" href="nestyles2.css">
<style type="text/css">
   P.link1 { text-indent: 880px;line-height: 20px;}
   P.link2 { text-indent: 905px;}
   A { font-size: 20px;}
   A.link1 { font-size: 20px;font-family: "MS Sans Serif"; text-indent: 120px;}
   A.link2 { font-size: 20px;font-family: "MS Sans Serif"; text-indent: 140px;}
   .container {
           width: 400px;
       }
  </style>
  <header>
  	<img src="img/nepokerhub.png">
<?php

if  (isset ($_SESSION["auth"])){
	if($_SESSION["auth"] == "true"){
	echo "<p><a href=\"nehandler.php\">User Page</a></p>";
	}
	elseif($_SESSION["auth"] == "false"){
	echo "<p><a href=\"nehandler.php\">User Page</a></p>"; 
	}
	}
else{
echo "<p><a href=\"nemain.php\">User Page</a></p>"; 
}
?>
</header>
 <div class="container">
 
<?php 
if($result)
{
	$curIndex=$_GET['id'];
    $rows = mysqli_num_rows($result);
	$rows_role = mysqli_num_rows($result_role);	// количество полученных строк
	$roles_arr = [[]]; 
	for ($i = 0 ; $i < $rows_role ; ++$i){
	$row_role = mysqli_fetch_array($result_role);
	$roles_arr[$i][0]=$row_role[1];	
	}	
echo "<div class=\"rowsInfo\">";
	for ($i = 0 ; $i < $rows ; ++$i){
			
		$row = mysqli_fetch_array($result);
			for ($j = 0 ; $j < 7 ; ++$j){
				if ($row[0]==$curIndex){
					$curphoto=$row["photo"];
					if ($j==0){
						echo("<div class=\"rowInfo\">");
						if(isset ($_SESSION["auth"]) && $_SESSION["auth"] == "true"){
						echo "<span>id</span> ";
						echo "<span><a href='needituserbyneadmin.php?id=".$row['id']."'>".$row['id']."</a></span><br>";
						}else{echo "<span>".$row[$j]."</span><br>";
						}
						echo ("</div>");
				    }
					if ($j!=0 && $j!=5 && $j!=4 && $j!=6){
						switch ($j) {
						case 1:
						echo("<div class=\"rowInfo\">");
						echo "<span>Name</span><br>";
						    echo "<span>$row[$j]</span><br>";
						    echo ("</div>");
						    break;
						case 2:
						echo("<div class=\"rowInfo\">");
						echo "<span>Surname</span><br>";
						     echo "<span>$row[$j]</span><br>";
						     echo ("</div>");
						    break;
						case 3:
							echo("<div class=\"rowInfo\">");
							echo "<span>Email</span><br>";
						    echo "<span>$row[$j].</span><br>";
						    echo ("</div>");
						    break;
						}
					}
					if ($row[$j]==1&& $j!=0){
						echo "<div class=\"rowInfo\">";
						echo "<span>Role</span><br>";
					echo "<span>".$roles_arr[0][0]."</span><br>";
					echo "</div>";
					}
					if ($row[$j]==2 && $j!=0){
						echo "<div class=\"rowInfo\">";
						echo "<span>Role</span><br>";
					echo "<span>".$roles_arr[1][0]."</span><br>";
					echo "</div>";
					}
					
				}
	}
	}
echo "</div>";



    mysqli_free_result($result);
	mysqli_free_result($result_role);

	
	}
mysqli_close($link);
?>
<div class="neRowsInfo">
<p><img class="photo" src="public/images/<?=$curphoto?>" width="160" height="160"></p> 
</div>
</div>
<footer>
	<p>© neLaba corp. All rights reserved</p>
</footer>
</body>
</html>

