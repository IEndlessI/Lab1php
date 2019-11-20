<link rel="stylesheet" href="nestyles.css">
<link rel="stylesheet" href="nestyles2.css">
<!doctype html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport"
         content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   
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
     <a href="nemain.php">Main page</a>
  </p>
  </header>
<div class="container">
  <?php
// Start the session
session_start();
//$login='admin';
//$password = '1111';
?>

   <form method="post">
       Name:<input type="text" name="first_name" value="Name" minlength="1">
       Surname:<input type="text" name="last_name" value="Surname" minlength="1">
       E-mail: <input type="text" name="email" minlength="1"><br>
       Password: <input type="password" name="password" minlength="6"><br>
      <input type="file" name="fileToUpload" id="fileToUpload" value="select img">
       <p><select  required  name="role">
    <option >Выберите роль</option>
    <option value="1">Admin</option>
    <option value="2">User</option>
    </select></p>
       <input type="submit" class="btn">
   </form>
</div>
<?php  
require_once 'connection.php'; //підключення скрипту
if (isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['email']) && isset($_POST['password'])&& isset($_POST['role'])){
  $sql = "INSERT INTO users (first_name, last_name, email, password, photo, id_role) VALUES ('{$_POST['first_name']}', '{$_POST['last_name']}','{$_POST['email']}','{$_POST['password']}','{$_POST['fileToUpload']}','{$_POST['role']}')";
  $result = $conn->query($sql);
header('Location: neindex.php');
}
?>

<footer>
   <p>© neLaba corp. All rights reserved</p>
 </footer>
</body>
</html>
