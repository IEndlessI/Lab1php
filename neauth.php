<?php 
session_start();

require_once 'neconnection.php'; // подключаем скрипт
 
$link = mysqli_connect($servername, $username, $password, $database) 
    or die("Ошибка " . mysqli_error($link)); 
     
$query ="SELECT * FROM users";

 
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
$rows = mysqli_num_rows($result);






$_SESSION["auth"]="nonreg";
    for ($i = 0 ; $i < $rows ; ++$i){

        
if (isset($_POST["email"])&&isset($_POST["password"])) {
  $row = mysqli_fetch_array($result);
    if ($_POST["email"]==$row["email"]){
      if ($_POST["password"]==$row["password"]) {
        if ($row["id_role"]==1) {
         $_SESSION["auth"]="true";
        }
         if ($row["id_role"]==2) {
         $_SESSION["auth"]="false";
        }
        $_SESSION["name"]=$row["first_name"];
        $_SESSION["email"]=$row["email"];
        $_SESSION["password"]=$row["password"];
        $_SESSION["id"]=$row["id"];
        $_SESSION["surname"]=$row["last_name"];
        $_SESSION["filephoto"]=$row["photo"];
      } 
    }
  }
}
header('Location: nehandler.php');
 ?>