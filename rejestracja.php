<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rejestracja</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body id = "Rejestracja">
<nav>
    <ul>
       <a class ="pod" href="index.php" ><li>Strona glowna</li></a>
       <a class ="pod" href="logowanie.php" ><li>Logowanie</li></a>
       <a class ="pod" href="rejestracja.php" ><li>Rejestracja</li></a>
    </ul>
    </nav>
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
        <button type="submit" id="przycisk" name="Przycisk">Zarejestruj</button>
</form>
    <?php
    error_reporting(1);
    session_start();
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
                
                while($row = mysqli_fetch_array($sqlsprawdzanie)){
                    if($row['login'] == $login){
                        echo "Login jest już zajęty";
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
                echo "Hasła nie są takie same";
            }
            }
            else{
            echo "Wypełnij wszystkie pola";
            }
        }

?>
    
</body>
</html>
