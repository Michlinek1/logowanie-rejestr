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
    $pol = new mysqli("localhost", "root", "", "baza");
    $sql = mysqli_query($pol, "SELECT * from posty");
    
    echo "<li><a class = 'pod' href = 'ustawienia.php'>Ustawienia</li></div>";
    echo "<li><a class = 'pod' href='wyloguj.php'>Wyloguj</a></li>";
    echo "</ul>";
    echo " </nav>";
    if($_SESSION['dodano'] == true){
        echo "<h2 class='tekst'>Dodałeś post!</h1>";
        unset($_SESSION['dodano']);
    }
    if($_SESSION['usunieto'] == true){
        echo "<h2 class='tekst'>Usunąłeś post!</h1>";
        unset($_SESSION['usunieto']);
    }
    if($_SESSION['edycja'] == true){
        echo "<h2 class='tekst'>Edytowałeś post!</h1>";
        unset($_SESSION['edycja']);
    }
    echo '<h1 class = "tekst">Zalogowany jako: '.$_SESSION['nick'].'</h1>';
    echo '<form action = "" method = "POST">';
    echo '<button id = "Przycisk" type =  "submit" name = "dodajpost"> + Dodaj post</button>';
    if(mysqli_num_rows($sql) > 0){
        echo "<button id = 'Przycisk' type = 'submit' name = 'Przyciskzobacz'>Zobacz Posty!</button>";
    }
    
    echo '</form>';

    if(isset($_POST['dodajpost'])){
        header('Location: dodajpost.php');
    }




    



        if(isset($_POST['Przyciskzobacz'])){
            $sql = mysqli_query($pol, "SELECT id from posty");
            header('Location: zobaczpost.php?id='.mysqli_fetch_assoc($sql)['id']);
            
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
