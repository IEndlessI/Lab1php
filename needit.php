<?php
// Start the session
session_start();
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

<!doctype html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport"
         content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
   <link rel="stylesheet" href="nestyles2.css">
   <style>
       .container {
           width: 400px;
       }
   </style>
</head>
<body>
  <header>
    <img src="img/nepokerhub.png">
    <p>
    <a class="link1"href="nehandler.php">User page</a>
    <a class="link1"href="nedelete.php">Delete Page</a>
  </p>
  </header>
<div class="container">
    <form method="post">
       <p><img  src="public/images/<?=$_SESSION["filephoto"]?>" width="160" height="160"></p> 
       First Name: <input type="text" name="first_name" value="<?=$_SESSION['name']?>">   
     Last Name: <input type="text" name="last_name"value="<?=$_SESSION['surname']?>">
	   Email: <input type="text" name="email"value="<?=$_SESSION['email']?>"><br>
	   Password: <input type="password" name="password" minlength="6"><br>
     <p><input type="file" name="fileToUpload" id="fileToUpload" value="select img"></p>
       <p><input type="submit" class="btn" value ="Edit"></p>
   </form>
  
</div>
</body>
</html>
<html>
<body>
<?php
require_once 'connection.php'; //підключення скрипту
if (isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['email']) && isset($_POST['password'])&& isset($_SESSION['id'])){
	$sql = "UPDATE users SET first_name='{$_POST['first_name']}',last_name='{$_POST['last_name']}',email='{$_POST['email']}',password='{$_POST['password']}',photo='{$_POST['fileToUpload']}' WHERE id='{$_SESSION['id']}'";
	$result = $conn->query($sql);
	header('Location: nesignout.php');
	}
?>


  <footer>
   <p>© neLaba corp. All rights reserved</p>
 </footer>
</body>
</html>