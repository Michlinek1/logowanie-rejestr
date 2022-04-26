<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ustawienia</title>
</head>
<body>

<?php
session_start();
$pol = new mysqli("localhost", "root", "", "baza");
$nick = $_SESSION["nick"];
$haslo = $_SESSION["haslo2"];
$result=mysqli_query($pol, "SELECT * FROM dane WHERE login = '$nick' and haslo2 = '$haslo'");
if ($result->num_rows>0) {
    while ($wiersz = $result->fetch_assoc()) {
        echo "Nick: ".$wiersz["login"]."<br>";
        echo "Hasło: ".$wiersz["haslo"]."<br>";
    }
}else{
    echo 'blad';
}

$przycisk = $_POST['Przycisk'];

if(isset($przycisk)){
    if(isset($_POST["inputhaslo"]) && $_POST["inputhaslo"]!=""){
        $haslo = $_POST["inputhaslo"];
        $sql = "UPDATE dane SET haslo2 = '$haslo' WHERE login = '$nick'";
        $result = mysqli_query($pol, $sql);
        if($result){
           header("location:index.php");
        }
        else{
            echo "Hasło nie zostało zmienione";
        }
    }
}



?>
<form action="" method="POST">
<input type = "text" name = "inputhaslo" placeholder="Nowe hasło">
<button type="submit" id="przycisk" name="Przycisk">Zmień hasło</button>
</form>

</body>
</html>