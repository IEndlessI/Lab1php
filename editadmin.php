<?php
// Start the session
session_start();
?>
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">


<!doctype html>
<html lang="en">
<head>
<style type="text/css">
   P.link1 { text-indent: 810px;line-height: 40px;}
   P.link2 { text-indent: 340px;}
   P.link3 { text-indent: -275px;}
   P.link4 { text-indent: -165px;}
   A { font-size: 20px;}
   A.link1 { font-size: 20px;font-family: "MS Sans Serif"; text-indent: 120px;}
   A.link2 { font-size: 20px;font-family: "MS Sans Serif"; text-indent: 140px;}
  </style>
   <meta charset="UTF-8">
   <meta name="viewport"
         content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
   <style>
       .container {
           width: 400px;
       }
   </style>
</head>
<body style="padding-top: 3rem;">
<div class="container">
   <form method="post">
       <p class="link5"><img class="link6" src="public/images/<?=$_SESSION["file_name"]?>" width="160" height="160"></p> First Name: <input type="text" name="first_name" value="<?=$_SESSION['first_name']?>">   
	   <p class="link3"><input type="file" name="fileToUpload" id="fileToUpload" value="select img"></p>Last Name: <input type="text" name="last_name"value="<?=$_SESSION['last_name']?>">
	   Email: <input type="text" name="email"value="<?=$_SESSION['email']?>"><br>
	   Password: <input type="password" name="password"><br>
	   Role: <input type="text" name="role"value="<?=$_SESSION['role']?>"><br>
       <p class="link2"><input type="submit" class="btn" value ="Edit"></p>
   </form>
   
  
</div>
</body>
</html>
<html>
<body>
<?php
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
if (isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['email']) && isset($_POST['password'])&& isset($_POST['role'])&& isset($_POST['fileToUpload'])){
	//$_SESSION["file_name"]=$_POST['fileToUpload'];
	$sql = "UPDATE users SET first_name='{$_POST['first_name']}',last_name='{$_POST['last_name']}',email='{$_POST['email']}',password='{$_POST['password']}',photo='{$_POST['fileToUpload']}',id_role='{$_POST['role']}' WHERE id='{$_SESSION['id']}'";
	$result = $conn->query($sql);
	header('Location: signout.php');
	}
?>
<p class="link1"><a class="link1"href="restricted.php">User page</a> | <a href="delete.php">Delete</a></p>
</body>
</html>