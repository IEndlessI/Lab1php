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
          margin-top: 4rem;
           width: 400px;
       }
   </style>
</head>
<body>
<header>
    <img src="img/nepokerhub.png">
    <p>
     <a href="neregistration.php">Registr Page</a><br>
     <a href="nemain.php">Main Page</a><br>
  </p>
  </header>
<div class="container">
  <?php
// Start the session
session_start();
//$login='admin';
//$password = '1111';
if (isset($_SESSION["log"])) {

if ($_SESSION["log"]=="false") {
    echo "Incorrect email or password<br>";
}
}
if (isset($_SESSION["log"])) {

  $_SESSION["log"]="true" ;

}

?>

   <form action="neauth.php" method="post">
       E-mail: <input type="text" name="email"><br>
       Password: <input type="password" name="password" minlength="6"><br>
      
       <input type="submit" class="btn">
   </form>




</div>
<footer>
   <p>© neLaba corp. All rights reserved</p>
 </footer>
</body>
</html>
