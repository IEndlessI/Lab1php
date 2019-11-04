
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

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
       Email: <input type="text" name="email"><br>
       Password: <input type="password" name="password"><br>
       <input type="submit" class="btn"value="Войти">
   </form>
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
session_start();
require_once 'connection.php'; // подключаем скрипт
 
$link = mysqli_connect($servername, $username, $password, $database) 
    or die("Ошибка " . mysqli_error($link)); 
     
$query ="SELECT * FROM users";
 
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
if (isset($_POST['email']) && isset($_POST['password']))
{
    $rows = mysqli_num_rows($result); // количество полученных строк
	
	for ($i = 0 ; $i < $rows ; ++$i){
		$row = mysqli_fetch_array($result);
			if (($row[3]==$_POST['email']) && ($row[4]==$_POST['password'])&&($row[6]==1)){
				$_SESSION["auth"] = True;
				$_SESSION["email"]=$_POST['email'];
				$_SESSION ["id"]=$row[0];
				$_SESSION ["first_name"]=$row[1];
				$_SESSION ["last_name"]=$row[2];
				$_SESSION ["file_name"]=$row[5];
				$_SESSION ["role"]=$row[6];
				header('Location: restricted.php');
				break;
			}elseif(($row[3]==$_POST['email']) && ($row[4]==$_POST['password'])&&($row[6]==2)){
				$_SESSION["auth"] = False;
				$_SESSION["email"]=$_POST['email'];
				$_SESSION ["id"]=$row[0];
				$_SESSION ["first_name"]=$row[1];
				$_SESSION ["last_name"]=$row[2];
				$_SESSION ["file_name"]=$row[5];
				$_SESSION ["role"]=$row[6];
				header('Location: restricted.php');
				break;
			}
			}
		
	

    // очищаем результат
    mysqli_free_result($result);

	}
mysqli_close($link);
?>
<p class="link1"><a href="registr.php">Registration page</a> | <a href="nonreg.php">Content page</a></p>
</body>
</html>
