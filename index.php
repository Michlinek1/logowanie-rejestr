<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_STRICT);


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
<body >
    
    <nav>
    <ul>
       <li><a class ="active" href="index.php" >Strona glowna</a></li>
       <li ><a class = "pod" href = "zgloszenia.php">Zgłoś Błąd</a></li>
       

    <?php
 if($_SESSION['zalogowany']){
    echo "<li><a class = 'pod' href = 'ustawienia.php'>Ustawienia</li></div>";
    echo "<li><a class = 'pod' href='wyloguj.php'>Wyloguj</a></li>";
    echo "</ul>";
    echo " </nav>";
    echo '<h1 class = "tekst">Zalogowany jako: '.$_SESSION['nick'].'</h1>';
    echo '<form action = "" method = "POST">';
    echo '<button id = "Przycisk" type =  "submit" name = "dodajpost"> + Dodaj post</button>';
    echo '</form>';

    if(isset($_POST['dodajpost'])){
        header('Location: dodajpost.php');
    }



    foreach($_SESSION['kategorie'] as $kategoria){
        

}

    $pol = new mysqli("localhost", "root", "", "baza");
    $zapytanie = $pol->query("SELECT * FROM posty"); 
    while($wiersz = $zapytanie->fetch_assoc()){
        echo '<div class = "column">';
        echo '<div class = "box">';
        echo '<h2 style = "text-align:center">'.$wiersz['tytul'].'</h2>';
        echo '<p  style = "text-align:center">'. "Kategoria:"." ".$wiersz['kategoria'].'</p>';
        echo '<p style = "text-align:center">'.$wiersz['data'].'</p>';
        echo '<p style = "text-align:center">'. "Autor:". " ".$wiersz['autor'].'</p>';
        echo '<form action = "" method = "POST">';
        echo "<button class = 'button' id = 'Przycisk' type='submit' name='Przyciskzobacz'> Zobacz Post</button>";
        echo $wiersz['ID'];
        if(isset($_POST['Przyciskzobacz'])){
            $_SESSION['id'] = $wiersz['ID'];
            header('Location: zobaczpost.php?id='.$_SESSION['id']);
            
        }
        echo "</form>";
        echo '</div>';
        echo '</div>';
  
    }
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
  
    <style>
        .column {
            float: left;
            width: 20%;
            padding: 5px;
            
        }
        .box{
            border: 1px solid #ccc;
            background-color: #f8f8f8;
            padding: 20px;
            text-align: center;
        }
        
</style>

</body>
</html> 
