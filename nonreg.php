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
<table class="table_blur">
<thead>
  <style type="text/css">
   P.link1 { text-indent: 860px;line-height: 40px;}
   P.link2 { text-indent: 1220px;}
   A { font-size: 20px;}
   A.link1 { font-size: 20px;font-family: "MS Sans Serif"; text-indent: 120px;}
   A.link2 { font-size: 20px;font-family: "MS Sans Serif"; text-indent: 140px;}
  </style>
	<tr><th>#</th><th>First name</th><th>Last name</th><th>Email</th><th>Role</th></tr>
</thead>
<tbody>
<?php
if($result)
{

    $rows = mysqli_num_rows($result);
	$rows_role = mysqli_num_rows($result_role);	// количество полученных строк
	$roles_arr = [[]]; 
	for ($i = 0 ; $i < $rows_role ; ++$i){
	$row_role = mysqli_fetch_array($result_role);
	$roles_arr[$i][0]=$row_role[1];	
	}	
	//echo "<table><tr><th>#</th><th>First name</th><th>Last name</th><th>Email</th><th>Role</th></tr>";
	for ($i = 0 ; $i < $rows ; ++$i){
			
		$row = mysqli_fetch_array($result);
			echo "<tr>";
			for ($j = 0 ; $j < 7 ; ++$j){	
				if ($j==0){
				echo "<td><a href='singleuser.php?id=".$row['id']."'>".$row['id']."</a></td>";
				}			
				if ($j!==0 && $j!=5 && $j!=4 && $j!=6){
				echo "<td>$row[$j]</td>";
				}
			}

				if ($row[6]==1){
					//$row_role = mysqli_fetch_array($result_role);
					echo "<td>".$roles_arr[0][0]."</td>";
				}
				if ($row[6]==2){
					//$row_role = mysqli_fetch_array($result_role);
					echo "<td>".$roles_arr[1][0]."</td>";
				}
			
			//echo "<td>$row_role[1]</td>";
			echo "</tr>";	
	}

//echo "</table>";

    // очищаем результат
    mysqli_free_result($result);
	mysqli_free_result($result_role);

	
	}
mysqli_close($link);
?>
<p class="link1"><a href="logindb.php" class="link1">Sign In</a> | <a href="registr.php" class="link2">Sign Up</a></p>
</tbody>
</table>
</body>
</html>