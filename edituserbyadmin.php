<?php
session_start();
require_once 'connection.php'; // подключаем скрипт
 
$link = mysqli_connect($servername, $username, $password, $database) 
    or die("Ошибка " . mysqli_error($link)); 
     
$query ="SELECT * FROM users";
$query_role ="SELECT * FROM roles";
 
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
$result_role = mysqli_query($link, $query_role) or die("Ошибка " . mysqli_error($link));
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
			for ($j = 0 ; $j < 7 ; ++$j){
				if ($row[0]==$curIndex){
					$curFirstName=$row[1];
					$curLastName=$row[2];
					$curEmail=$row[3];
					$curPassword=$row[4];
					$curPhoto=$row[5];
					$curIdRole=$row[6];
					
				}
	}
	}




    mysqli_free_result($result);
	mysqli_free_result($result_role);

	
	}
mysqli_close($link); 
?>
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">


<!doctype html>
<html lang="en">
<head>
<style type="text/css">
   P.link1 { text-indent: 770px;line-height: 40px;}
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
       <p class="link5"><img class="link6" src="public/images/<?=$curPhoto?>" width="160" height="160"></p> First Name: <input type="text" name="first_name" value="<?=$curFirstName?>">   
	   <p class="link3"><input type="file" name="fileToUpload" id="fileToUpload" value="select img"></p>Last Name: <input type="text" name="last_name"value="<?=$curLastName?>">
	   Email: <input type="text" name="email"value="<?=$curEmail?>"><br>
	   Password: <input type="password" name="password"><br>
	   Role: <input type="text" name="role"value="<?=$curIdRole?>"><br>
       <p class="link2"><input type="submit" class="btn" value ="Edit"></p>
   </form>
   
 <?php
 if (isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['email']) && isset($_POST['password'])&& isset($_POST['role'])&& isset($_POST['fileToUpload'])){
	//$_SESSION["file_name"]=$_POST['fileToUpload'];
	$sql = "UPDATE users SET first_name='{$_POST['first_name']}',last_name='{$_POST['last_name']}',email='{$_POST['email']}',password='{$_POST['password']}',photo='{$_POST['fileToUpload']}',id_role='{$_POST['role']}' WHERE id='{$curIndex}'";
	$result = $conn->query($sql);
	header('Location: restricted.php');
	}
 ?>
</div>
</body> 
</html>
<html>
<body>
<p class="link1"><a class="link1"href="restricted.php">User page</a> |<a href="delete.php?id=<?= $_GET["id"]?>">Delete</a></p>
</body>
</html>