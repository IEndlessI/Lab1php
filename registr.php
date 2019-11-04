<?php
// Start the session
session_start();
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
<link rel="stylesheet" href="style.css">

<!doctype html>
<html lang="en">
<head>
<style type="text/css">
   P.link1 { text-indent: 570px;line-height: 40px;}
   P.link2 { text-indent: 1220px;}
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
       First Name: <input type="text" name="first_name"><br>
       Last Name: <input type="text" name="last_name"><br>
	   Email: <input type="text" name="email"><br>
	   Password: <input type="password" name="password"><br>
	   <select  name="country">
 <option value="Австралия">Австралия</option>
 <option value="Австрия">Австрия</option>
 <option value="Азербайджан">Азербайджан</option>
 <option value="Албания">Албания</option>
 <option value="Алжир">Алжир</option>
</select>
	   Role: <input type="text" name="role"><br>
	   <input type="file" name="fileToUpload" id="fileToUpload" value="select img"> 
	  <!--<select name="id_role" id="id_role">
                    <option>1</option>
                    <option>2</option>
                </select><br>
	    <p><select size="3" required  name="role">
		<option disabled>Выберите роль</option>
		<option value="1">Admin</option>
		<option value="2">User</option>
		</select></p>-->
       <p><input type="submit" class="btn" value="Registration"></p>
   </form>
  <!-- <form method "post">
   <p><strong>Выберите роль</strong></p>
   <p><select name="role">
    <option value="1" selected>NonRegUser</option>
    <option value="2">User</option>
    <option value="3">Admin</option>
   </select> 
   <input type="submit" class="btn"></p>
  </form> -->
</div>
</body>
</html>

<html>
<body>
<!--<form method="POST"> --указание метода POST
Login: <input type="text" name="login" value="">
Password: <input type="text" name="password" value="">
<input type="submit" value="Отправить">
</form>-->
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
if (isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['email']) && isset($_POST['password'])&& isset($_POST['role'])){
	$sql = "INSERT INTO users (first_name, last_name, email, password, photo, id_role) VALUES ('{$_POST['first_name']}', '{$_POST['last_name']}','{$_POST['email']}','{$_POST['password']}','{$_POST['fileToUpload']}','{$_POST['role']}')";
	$result = $conn->query($sql);
}
	
?>
<p class="link1"><a href="logindb.php">Login page</a> | <a href="nonreg.php">User page</a></p>
</body>
</html>