<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$database = "testdb"; //повинна бути створена в субд

require_once 'neconnection.php'; // подключаем скрипт
 
$link = mysqli_connect($servername, $username, $password, $database) 
    or die("Ошибка " . mysqli_error($link)); 
     
$query ="SELECT * FROM users";

 
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
$rows = mysqli_num_rows($result);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"];
	}
}

?>