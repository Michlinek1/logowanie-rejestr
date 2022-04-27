<?php
session_start()
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Strona Główna</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="style.php" media="screen">
</head>
<body>
    <nav>
    <ul>
       <li><a class ="active" href="index.php" >Strona glowna</a></li>
    <?php
 if($_SESSION['zalogowany']){
    echo "<li><a class = 'pod' href = 'ustawienia.php'>Ustawienia</li></div>";
    echo "<li><a class = 'pod' href='wyloguj.php'>Wyloguj</a></li>";
    echo "</ul>";
    echo " </nav>";
    echo '<h1 class = "tekst" ">Zalogowany jako: '.$_SESSION['nick'].'</h1>';
            
}
else{
    echo "<li><a class ='pod' href='logowanie.php' >Logowanie</a></li>";
    echo "<li><a class ='pod' href='rejestracja.php' >Rejestracja</a></li>";
    echo "</ul>";
    echo " </nav>";
    echo '<h1 class = "tekst">Nie jesteś zalogowany!'."</h1>'";
    echo '<h1 class = "tekst">Zaloguj albo zarejestruj się aby korzystać z serwisu!'."</h1>";

}


?>
    
</body>
</html> 
