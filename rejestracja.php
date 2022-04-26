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
            <input type="text" class="form-control" id="login" name="login" placeholder="Wpisz login" autocomplete="off"> <br><br>
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
    //error_reporting(0);
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
      $sqlsprawdzanie = "SELECT login, haslo FROM dane";
      $result = mysqli_query($pol,$sqlsprawdzanie);
      
    $przycisk = $_POST['Przycisk'];
    $login = $_POST['login'];
    $haslo = $_POST['password'];
    $haslo2 = $_POST['password2'];
    /*if($result->num_rows>1) {
        while ($wiersz = $result->fetch_assoc()) {
            if(isset($przycisk) && ($login != "") && ($haslo != "") && ($haslo2 != "") && ($haslo == $haslo2) && ($login != $wiersz['login'])){
                    $zhashowanehaslo = password_hash($haslo, PASSWORD_DEFAULT);
                    $dodawanie = mysqli_query($pol, "insert into dane (login, haslo, haslo2) values ('$login', '$zhashowanehaslo', '$haslo2')");
                    header("Location: logowanie.php ");
                }elseif($result->num_rows>1) {
                    while ($wiersz = $result->fetch_assoc()) {
                        if($wiersz['login'] == $login){
                            echo "Taki login już istnieje";
                        }
                    }
                }
            }
        }   
                        
        else{
            echo "Proszę się zarejstrować!" . "<br>";
        }
        */
        if(!empty($login)){
            if(!empty($haslo)){
                if(!empty($haslo2)){
                    if($haslo == $haslo2){
                        if(mysqli_num_rows($result)>0){
                            while($wiersz = mysqli_fetch_assoc($result)){
                                if($wiersz['login'] == $login){
                                    echo "Taki login już istnieje";
                                }
                            }
                        }else{
                            $zhashowanehaslo = password_hash($haslo, PASSWORD_DEFAULT);
                            $dodawanie = mysqli_query($pol, "INSERT INTO dane (login, haslo, haslo2) values ('$login', '$zhashowanehaslo', '$haslo2')");
                            header("Location: logowanie.php ");
                        }
                    }else{
                        echo "Hasła nie są takie same";
                    }
                }else{
                    echo "Proszę wpisać hasło";
                }
            }else{
                echo "Proszę wpisać hasło";
            }
        }
       




?>
    
</body>
</html>