<?php
// Start the session
session_start();
?>

<!doctype html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport"
         content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <link rel="stylesheet" href="nestyles.css">
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
     <a style="margin-right: 15px" href="nehandler.php">User page</a>
     <a href="nedelete.php?id=<?= $_GET["id"]?>">Delete page</a></p>
  </p>
  </header>
<div class="container">
  <?php
  require_once 'connection.php'; //підключення скрипту
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
  $rows_role = mysqli_num_rows($result_role); // количество полученных строк
  $roles_arr = [[]]; 
  for ($i = 0 ; $i < $rows_role ; ++$i){
  $row_role = mysqli_fetch_array($result_role);
  $roles_arr[$i][0]=$row_role[1]; 
  } 

  for ($i = 0 ; $i < $rows ; ++$i){
      
    $row = mysqli_fetch_array($result);
      echo "<tr>";
      for ($j = 0 ; $j < 7 ; ++$j){
        if ($row[0]==$curIndex){
          $curName=$row["first_name"];
          $curSur=$row["last_name"];
          $curEmail=$row["email"];
          $curPhoto=$row["photo"];
  }
}
  echo "</tr>";
  }
}

  ?>
    <form method="post">
       <p><img  src="public/images/<?=$curPhoto?>" width="160" height="160"></p> 
       First Name: <input type="text" name="first_name" value="<?=$curName?>">   
     Last Name: <input type="text" name="last_name"value="<?=$curSur?>">
	   Email: <input type="text" name="email"value="<?=$curEmail?>"><br>
	   Password: <input type="password" name="password" minlength="6"><br>
     <p><input type="file" name="fileToUpload" id="fileToUpload" value="select img"></p>
      <p><select  required  name="role">
    <option >Выберите роль</option>
    <option value="1">Admin</option>
    <option value="2">User</option>
    </select></p>
       <p><input type="submit" class="btn" value ="Edit"></p>
   </form>
  
</div>
</body>
</html>
<html>
<body>
<?php
require_once 'connection.php'; //підключення скрипту
$current_index=$_GET['id'];
if (isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['email']) && isset($_POST['password'])&&isset($_POST['role'])&& isset($_SESSION['id'])){
	$sql = "UPDATE users SET first_name='{$_POST['first_name']}',last_name='{$_POST['last_name']}',email='{$_POST['email']}',password='{$_POST['password']}',photo='{$_POST['fileToUpload']}',id_role='{$_POST['role']}' WHERE id='{$current_index}'";
	$result = $conn->query($sql);
  $_SESSION["auth"]="true";
	header('Location: nehandler.php');
	}
?>

<footer>
   <p>© neLaba corp. All rights reserved</p>
 </footer>
</body>
</html>