<?php
error_reporting(0);
session_start()
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logowanie</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="style.php" media="screen">
</head>
<body id="Rejestracja">
<nav>
    <ul>
       <li><a class ="pod" href="index.php" >Strona glowna</a></li>
       <li><a class ="active" href="logowanie.php" >Logowanie</a></li>
       <li><a class ="pod" href="rejestracja.php" >Rejestracja</a></li>
<?php
if($_SESSION['zalogowany']==true){
    echo "<li><a class = 'pod' href = 'ustawienia.php'>Ustawienia</li>";
    echo "<li><a class = 'pod' href='wyloguj.php'>Wyloguj</a></li>";
    echo "</ul>";
    echo " </nav>";
}
else{   
    echo "</ul>";
    echo " </nav>";
}


?>
<form method="POST">
<div class="form-group">
<input type="text" name="nick" class="form-control" placeholder="Nazwa użytkownika" autocomplete="off">
</div>
<br>
<br>
<div class="form-group">
<input type="password" name="haslo" class="form-control" placeholder="Hasło"> 
</div>
<br>
<br>  
<button type="submit" id="Przycisk" name="Przycisk">Zaloguj się</button>
</form>
<?php
if($_SESSION['wiadomosc'] == true){
    echo "<h2 class='tekst'>Zarejestrowałeś się pomyślnie </h1>";
    unset($_SESSION['wiadomosc']);
}
$_SESSION['nick'] = $_POST['nick'];
$_SESSION['haslo'] = $_POST['haslo'];

$pol = new mysqli("localhost", "root", "", "baza");
$result=mysqli_query($pol, "SELECT * FROM dane WHERE login = '$_POST[nick]'");
if ($result->num_rows>0) {
    while ($wiersz = $result->fetch_assoc()) {
        if($_SESSION["nick"]==$wiersz["login"] && $_SESSION["haslo"]==$wiersz["haslo2"]){
            $_SESSION["zalogowany"] = true;
            header("location:index.php");
            exit();


        }
        
        }
    }

else {
    echo "<h2 class = 'tekst'>Wpisz poprawne dane! </h2>";
}




?>
</body>
</html>
