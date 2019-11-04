<?php
// Start the session
session_start();
?>
<?php
if (isset ($_GET['id'])){
	$curIndex=$_GET['id'];
	$_SESSION['id']=$curIndex;
}

$servername = "localhost";
$username = "root";
$password = "";
$database = "testdb"; //повинна бути створена в субд
// Встановлення з'єднання 
$conn = new mysqli($servername, $username, $password, $database);

// Перевірка з'єднання
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
require_once 'connection.php'; //підключення скрипту
	$sql = "DELETE FROM users WHERE id='{$_SESSION['id']}'";
	$result = $conn->query($sql);
	if (isset ($curIndex)){
	header('Location: restricted.php');	
	}else {header('Location: signout.php');}
?>
