<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "testdb"; //повинна бути створена в субд
session_start();
require_once 'connection.php'; // подключаем скрипт
 
$link = mysqli_connect($servername, $username, $password, $database) 
    or die("Ошибка " . mysqli_error($link)); 
     
$query ="SELECT * FROM users";
$query_role ="SELECT * FROM roles";
 
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
$result_role = mysqli_query($link, $query_role) or die("Ошибка " . mysqli_error($link));  
?>

<link rel="stylesheet" href="style.css">
<!doctype html>
<html>
<body>
<style type="text/css">
   P.link1 { text-indent: 880px;line-height: 20px;}
   P.link2 { text-indent: 905px;}
   A { font-size: 20px;}
   A.link1 { font-size: 20px;font-family: "MS Sans Serif"; text-indent: 120px;}
   A.link2 { font-size: 20px;font-family: "MS Sans Serif"; text-indent: 140px;}
  </style>
<table class="table_blur">
<thead>

	<tr><th>#</th><th>First name</th><th>Last name</th><th>Email</th><th>Role</th></tr>
</thead>
<tbody>
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

	for ($i = 0 ; $i < $rows ; ++$i){
			
		$row = mysqli_fetch_array($result);
			echo "<tr>";
			for ($j = 0 ; $j < 7 ; ++$j){
				if ($row[0]==$curIndex){
					if ($j==0){
						if(isset ($_SESSION["auth"]) && $_SESSION["auth"] == True){
						echo "<td><a href='edituserbyadmin.php?id=".$row['id']."'>".$row['id']."</a></td>";
						}else{echo "<td>$row[$j]</td>";
						}
				    }
					if ($j!=0 && $j!=5 && $j!=4 && $j!=6){
					echo "<td>$row[$j]</td>";
					}
					if ($row[$j]==1&& $j!=0){
					echo "<td>".$roles_arr[0][0]."</td>";
					}
					if ($row[$j]==2 && $j!=0){
					echo "<td>".$roles_arr[1][0]."</td>";
					}
					
				}
	}
	echo "</tr>";
	}




    mysqli_free_result($result);
	mysqli_free_result($result_role);

	
	}
mysqli_close($link);
?>
<?php
if  (isset ($_SESSION["auth"])){
	if($_SESSION["auth"] == True){
	echo "<p class=\"link2\"><a href=\"restricted.php\">User Page</a></p>";
	}
	elseif($_SESSION["auth"] == False){
	echo "<p class=\"link2\"><a href=\"restricted.php\">User Page</a></p>"; 
	}
	}
else{
echo "<p class=\"link2\"><a href=\"nonreg.php\">User Page</a></p>"; 
}
?>
</tbody>
</table>
</body>
</html>

