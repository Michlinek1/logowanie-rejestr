<?php
error_reporting(0);
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rejestracja</title>
<link rel="stylesheet" href="style.php" media="screen">
    <link rel="stylesheet" href="style.css">
    
</head>
<body id = "Rejestracja">
<nav>
    <ul>
       <li><a class ="pod" href="index.php" >Strona glowna</a></li>
       <li><a class ="pod" href="logowanie.php" >Logowanie</a></li>
       <li><a class ="active" href="rejestracja.php" >Rejestracja</a></li>
    <?php

if($_SESSION['zalogowany']==true){
    echo "<li><a class = 'pod' href = 'ustawienia.php'>Ustawienia</li></div>";
    echo "<li><a class = 'pod' href='wyloguj.php'>Wyloguj</a></li>";
    echo "</ul>";
    echo " </nav>";
}
else{   
    echo "</ul>";
    echo " </nav>";
}

?>
    <form method="post">
        <div class="form-group">
            <input type="text" class="form-control" id="login" name="login" placeholder="Wpisz login"   autocomplete="off" > <br><br>
        </div>
        <div class="form-group">
            <input type="password" class="form-control" id="password" name="password" placeholder="Wpisz hasło"> <br><br>
        </div>
        <div class="form-group">
            <input type="password" class="form-control" id="password2" name="password2" placeholder="Powtórz hasło"><br><br>
        </div>
        <button type="submit" id="Przycisk" name="Przycisk">Zarejestruj</button>
</form>
    <?php
    error_reporting(1);
    $pol = new mysqli("localhost", "root", "", "baza");
    if (mysqli_connect_error()) {
      die("Nie Połączono" . mysqli_connect_error())."<br>";
    }
    $sql  = mysqli_query($pol, "create table if not exists dane (
        ID int NOT NULL  AUTO_INCREMENT,
        login VARCHAR(20)  NOT NULL,
        haslo VARCHAR(20)  NOT NULL,
        haslo2 VARCHAR(20)  NOT NULL,
        PRIMARY KEY (ID)
      )");
      $sqlsprawdzanie = mysqli_query($pol,"SELECT login from dane");
    
      
    $przycisk = $_POST['Przycisk'];
    $login = $_POST['login'];
    $haslo = $_POST['password'];
    $haslo2 = $_POST['password2'];
        if(isset($przycisk)){
            if(!empty($login) && !empty($haslo) && !empty($haslo2)){
            if($haslo == $haslo2){
                if($login == "admin" || $haslo = "admin"){
                    echo "<h2 class='tekst'>Nie możesz użyć hasła lub loginu admin</h1>";
                }

                
                while($row = mysqli_fetch_array($sqlsprawdzanie)){
                    if($row['login'] == $login){
                        echo "<h1 class='tekst'>Login jest już zajęty </h1>";
                        break;
                    }
                }
                
                if($row['login'] != $login){
                    $sql = mysqli_query($pol, "INSERT INTO dane (login, haslo, haslo2) VALUES ('$login', '$haslo', '$haslo2')");
                    $_SESSION['wiadomosc'] =true;
                    header("Location: logowanie.php");
                    exit();
                }
            }
            else{
                echo "<h2 class='tekst'>Hasla nie są takie same! </h2>";
            }
            }
            else{
            echo "<h2 class='tekst'>Wypełnij wszystkie pola </h1>";
            }
            
        }
      
?>
    
</body>
</html>
