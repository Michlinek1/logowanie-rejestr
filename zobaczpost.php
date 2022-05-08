<?php
session_start( );
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="style.php" media="screen">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script defer src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
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
        echo '<div class = "przyciski">';
        echo "<form method = 'POST'>";
        echo "<button class='bold'  id = 'like' name = 'like' type = 'submit'> <i class='fa fa-thumbs-up' id =faup ></i>"."<span class = 'liczba'>".$wiersz['przycisklike']."</span> </button>";
        echo " <button class='bold' id = 'dislike' name = 'dislike' type = 'submit'><i class='fa fa-thumbs-down' id =fadown></i>"."<span class = 'liczba'>".$wiersz['dislike']."</span> </button>";
        echo '</div>';
        if(isset($_POST['like'])){
            $sql = mysqli_query($pol, "UPDATE posty SET przycisklike = przycisklike + 1 WHERE ID = '$_GET[id]'");
            header("Location: zobaczpost.php?id=$_GET[id]");
        }
        if(isset($_POST['dislike'])){
            $sql = "UPDATE posty SET dislike = dislike + 1 WHERE ID = '$_GET[id]'";
            $pol->query($sql);
            header("Location: zobaczpost.php?id=$_GET[id]");
        }
        if(mysqli_num_rows($zapytanie1) == $_GET['id'] ){
           ;
        }else{
            echo '<button class = "button"id = "Przycisk" onclick="window.location.href=\'zobaczpost.php?id='.(intval($wiersz['ID'] + 1)).'\'">Zobacz następny post</button>';
        }
        if($wiersz['ID'] >1 && mysqli_num_rows($zapytanie1) > 1){
            echo '<button class = "button"id = "Przycisk" onclick="window.location.href=\'zobaczpost.php?id='.(intval($wiersz['ID'] - 1)).'\'">Zobacz poprzedni post</button>';
        }
        if($_SESSION['nick'] == $wiersz['autor']){
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
    
    
    }
    .fa{
        font-size: 50px;
    }
    .przyciski{
        display: flex;
        justify-content: center;
        text-align: center;
        
        
    }
    .liczba{
        font-size: 30px;
        

    }
    .bold{
        cursor: pointer;
        padding: 0;
        border: none;
        background: none;
    }
        

    #faup{
        color: #4CAF50;
    }
    #fadown{
        color: #f44336;
    }
    </style>
</body>
</html>
