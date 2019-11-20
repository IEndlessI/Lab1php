<?php
session_start();


require_once 'neconnection.php'; // подключаем скрипт
 
$link = mysqli_connect($servername, $username, $password, $database) 
    or die("Ошибка " . mysqli_error($link)); 
     
$query ="SELECT * FROM users";
$query_role ="SELECT * FROM roles";
 
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
$result_role = mysqli_query($link, $query_role) or die("Ошибка " . mysqli_error($link));
$rows = mysqli_num_rows($result);
?>
<!DOCTYPE HTML>
<html>
 <head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
   <link rel="stylesheet" href="nestyles2.css">
   <style>
       .container {
           width: 700px;
       }
   </style>
 <body>
  <header>
    <img src="img/nepokerhub.png">
    <p>
     <a style="margin-right: 10px" href="neindex.php">Login Page</a>
    <a href="neregistration.php">Registr Page</a>
  </p>
  </header>
 	<div class="container">
 	<table>
 	<tr>
    <th>#</th>
    <th>Name</th>
    <th>Surname</th>
    <th>Email</th>
    <th>Role</th>
   </tr>
   <?php
  
    $rows_role = mysqli_num_rows($result_role);	// количество полученных строк
	$roles_arr = [[]]; 
	for ($i = 0 ; $i < $rows_role ; ++$i){
	$row_role = mysqli_fetch_array($result_role);
	$roles_arr[$i][0]=$row_role[1];	
	}
if ($result->num_rows > 0) {
    // output data of each row
    for ($i = 0 ; $i < $rows ; ++$i){
    	$row = mysqli_fetch_array($result);
    	echo "<tr>";
        echo "<td> <a href='nesingleuser.php?id=".$row['id']."'>".$row['id']."</a></td>";
        echo " <td> " .$row["first_name"]."</td>";
        echo " <td> " .$row["last_name"]."</td>";
        echo " <td> " .$row["email"]."</td>";
        if ($row["id_role"]==1) {
        	echo " <td> " .$roles_arr[0][0]."</td>";
        }else{
        	echo " <td> " .$roles_arr[1][0]."</td>";
        }
        echo "</tr>";
	}
}
 mysqli_free_result($result);
 mysqli_free_result($result_role);
?>
 	</table>
 </div>
 <footer>
   <p>© neLaba corp. All rights reserved</p>
 </footer>
 	</body>
</html>