




<?php
// Start the session
session_start();
 require_once 'neconnection.php'; // подключаем скрипт
 
$link = mysqli_connect($servername, $username, $password, $database) 
    or die("Ошибка " . mysqli_error($link)); 
     
$query ="SELECT * FROM users";
$query_role ="SELECT * FROM roles";

 
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
$result_role = mysqli_query($link, $query_role) or die("Ошибка " . mysqli_error($link));
$rows = mysqli_num_rows($result);
$_SESSION["log"]="true";
?>





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
           width: 700px;
       }
   </style>
</head>
<body>
<header>
    <img src="img/nepokerhub.png">
    <p>
     <?php
  if (isset($_SESSION["auth"])) {
    if ($_SESSION["auth"]=="false") {  
     echo "<a href=\"needit.php\">".$_SESSION["name"]." </a>|<a href=\"nesignout.php\"> Sign out</a><br>";
   }
   if ($_SESSION["auth"]=="true") {
    echo "<a href=\"neregistrationbyadmin.php\">Register new user</a><br>";
    echo "<a href=\"needitadmin.php\">".$_SESSION["name"]." </a>|<a href=\"nesignout.php\"> Sign out</a><br>";
  }
}
   ?>
  </p>
  </header>
<div class="container">
  <?php
  if (isset($_SESSION["auth"])) {
  if($_SESSION["auth"]=="nonreg"){
      $_SESSION["log"]="false";
      header('Location:neindex.php');
    }
  if ($_SESSION["auth"]=="false") {  
   echo "Welcome <a href=\"needit.php\">".$_SESSION["name"]."</a><br>";
   echo "Your email address is: ". $_SESSION["email"];
   }
   if ($_SESSION["auth"]=="true") {
   echo "Welcome <a href=\"needitadmin.php\">".$_SESSION["name"]."</a><br>";
   echo "Your email address is: ". $_SESSION["email"];
     }
   }else{
    header('Location:nemain.php');
  }?>

    <table>
      <tr>
    <th>#</th>
    <th>Name</th>
    <th>Surname</th>
    <th>Email</th>
    <th>Role</th>
    <?php
    if ($_SESSION["auth"]=="true") {
      echo"<th>Password</th>";
    }

     ?>
   </tr>
    <?php
    if ($result->num_rows > 0) {
      $rows_role = mysqli_num_rows($result_role); // количество полученных строк
  $roles_arr = [[]]; 
  for ($i = 0 ; $i < $rows_role ; ++$i){
  $row_role = mysqli_fetch_array($result_role);
  $roles_arr[$i][0]=$row_role[1]; 
  }
    // output data of each row
    for ($i = 0 ; $i < $rows ; ++$i){
      $row = mysqli_fetch_array($result);
      echo "<tr>";
        echo "<td> <a href='nesingleuser.php?id=".$row['id']."'>".$row['id']."</a></td>";
        echo " <td> " .$row["first_name"]."</td>";
        echo " <td> " .$row["last_name"]."</td>";
        echo " <td> " .$row["email"]."</td>";
        
         if ($row["id_role"]==1) {
          echo " <td> " .$roles_arr[0][0]."</td>";
        }else{
          echo " <td> " .$roles_arr[1][0]."</td>";
        }
        if ($_SESSION["auth"]=="true") {
          echo "<td>" .$row["password"]."</td>";
        }
        echo "</tr>";
  
  }
}

    ?>
</table>
</div>
<footer>
   <p>© neLaba corp. All rights reserved</p>
 </footer>
</body>
</html>
