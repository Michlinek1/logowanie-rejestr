<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logowanie</title>
    <link rel="stylesheet" href="style.css">
</head>
<body id="Rejestracja">
<?php
session_start();
error_reporting(1);
$ok=True;
?>
<nav>
    <ul>
       <a class ="pod" href="index.php" ><li>Strona glowna</li></a>
       <a class ="pod" href="logowanie.php" ><li>Logowanie</li></a>
       <a class ="pod" href="rejestracja.php" ><li>Rejestracja</li></a>
    </ul>
    </nav>
<form method="POST">
<div class="form-group">
<input type="text" name="nick" class="form-control" placeholder="Nazwa użytkownika">
</div>
<br>
<br>
<div class="form-group">
<input type="text" name="haslo" class="form-control" placeholder="Hasło"> 
</div>
<br>
<br>  
<input type="submit" value="Zaloguj się" id="przycisk">
</form>
<?php
$nick = $_SESSION["nick"];
$_SESSION["nick"]=$_POST["nick"];
$_SESSION["haslo"]=$_POST["haslo"];
$pol = new mysqli("localhost", "root", "", "baza");
$result=mysqli_query($pol, "SELECT * FROM dane WHERE login = '$_SESSION[nick]'");
if ($result->num_rows>0) {
    while ($wiersz = $result->fetch_assoc()) {
        if($_SESSION["nick"]==$wiersz["login"] && $_SESSION["haslo"]==$wiersz["haslo2"]){
            $_SESSION["zalogowany"]=True;
            header("location:index.php");
        }
    }
}
else {
    echo "Wpisz poprawne dane!";
}



?>
</body>
</html>