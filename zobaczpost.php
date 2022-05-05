<?php
session_start( );

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="style.php" media="screen">
    <title><?php 
            $pol = new mysqli("localhost", "root", "", "baza");
            $zapytanie = $pol->query("SELECT tytul FROM posty WHERE ID = '$_GET[id]'");
            while($wiersz = $zapytanie->fetch_assoc()){
            echo $wiersz['tytul'];
            }
            
            ?></title>
</head>
<body>
<nav>
    <ul>
       <li><a class ="pod" href="index.php" >Strona glowna</a></li>
       <li><a class ="pod" href="ustawienia.php" >Ustawienia</a></li>
        <li><a class ="pod" href="wyloguj.php">Wyloguj</a></li>
        <li><a class ="active" href="#" >Post</a></li>
    </ul>
  </nav>
    <?php
    $pol = new mysqli("localhost", "root", "", "baza");
    $zapytanie = $pol->query("SELECT * FROM posty WHERE ID = '$_GET[id]'");
    $zapytanie1 = $pol -> query("SELECT ID FROM posty");
    while($wiersz = $zapytanie->fetch_assoc()){
        echo '<div class = "column">';
        echo '<div class = "box">';
        echo '<h2 style = "text-align:center">'."Autor:". " " .$wiersz['tytul'].'</h2>';
        echo '<p  style = "text-align:center">'. "Kategoria:"." ".$wiersz['kategoria'].'</p>';
        echo '<p style = "text-align:center">'."Data:". " " .$wiersz['data'].'</p>';
        echo '<p style = "text-align:center">'. "Autor:". " ".$wiersz['autor'].'</p>';
        echo '</div>';
        echo '</div>';
        echo '<textarea  readonly style = "text-align:center">'.$wiersz['tekst'].'</textarea>';
        if(mysqli_num_rows($zapytanie1) == $_GET['id'] ){
           ;
        }else{
            echo '<button class = "button"id = "Przycisk" onclick="window.location.href=\'zobaczpost.php?id='.(intval($wiersz['ID'] + 1)).'\'">Zobacz następny post</button>';
        }
        if($wiersz['ID'] >1 && mysqli_num_rows($zapytanie1) > 1){
            echo '<button class = "button"id = "Przycisk" onclick="window.location.href=\'zobaczpost.php?id='.(intval($wiersz['ID'] - 1)).'\'">Zobacz poprzedni post</button>';
        }
        if($_SESSION['nick'] == $wiersz['autor']){
            echo "<form method = 'POST'>";
            echo '<button class = "button" name = "PrzyciskUsun"id = "Przycisk" style = "background-color:red">Usuń post</button>';
            echo "</form>";
            if(isset($_POST['PrzyciskUsun'])){
                $pol->query("DELETE FROM posty WHERE ID = '$_GET[id]'");
                $pol ->query("ALTER TABLE posty AUTO_INCREMENT = 1;");
                $_SESSION['usunieto'] = true;
                header("Location: index.php");
                exit();
            }
          
        }
    }

?>
    <style>
textarea{
  width: 100%;
  height: 150px;
  padding: 12px 20px;
  box-sizing: border-box;
  border: 2px solid #ccc;
  border-radius: 4px;
  background-color: #f8f8f8;
  font-size: 16px;
  resize: none;
}
.box{
    border: 1px solid #ccc;
    background-color: #f8f8f8;
    padding: 20px;
    text-align: center;
    box-sizing: border-box;
    box-shadow: rgba(255, 255, 255, 0.2) 0px 0px 0px 1px inset, rgba(0, 0, 0, 0.9) 0px 0px 0px 1px;
    
    }
    </style>
</body>
</html>
