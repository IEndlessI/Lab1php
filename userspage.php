<!doctype html>
<html>
<body>
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

$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
if($result)
{
    $rows = mysqli_num_rows($result); // количество полученных строк
	echo "<table><tr><th>First name</th><th>Last name</th><th>Email</th><th>Password</th><th>Role</th><th>Photo</th></tr>";
	for ($i = 0 ; $i < $rows ; ++$i){
		$row = mysqli_fetch_array($result);
			echo "<tr>";
			for ($j = 1 ; $j < 7 ; ++$j){
				if ($j!=5){
				echo "<td>$row[$j]</td>";
				}
			}
			echo '<td><img src="public/images/'.$row[5].'" width="60" height="60"></br></td>';
			echo "</tr>";	
	}

    // очищаем результат
    mysqli_free_result($result);

	}
mysqli_close($link);
?>
<p><a href="registr.php">Registration page</a></p>
<p><a href="restricted.php">Content page</a></p>
</body>
</html>
