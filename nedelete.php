<?php
// Start the session
session_start();
?>
<?php
if (isset ($_GET['id'])){
 $curIndex=$_GET['id'];
 $_SESSION['id']=$curIndex;
}
require_once 'connection.php'; //підключення скрипту
 $sql = "DELETE FROM users WHERE id='{$_SESSION['id']}'";
 $result = $conn->query($sql);
 if (isset ($curIndex)){
 header('Location: nehandler.php'); 
 }else {header('Location: nesignout.php');}
?>