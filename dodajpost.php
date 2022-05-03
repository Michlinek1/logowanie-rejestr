<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dodaj Post</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="style.php" media="screen">
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
    <h1 class = "tekst">Dodaj Post</h1>
    <form method = "POST">
        <input type = "text" name = "Tytul" placeholder = "Tytuł" required>
        <textarea  id = "TextArea" name ="textarea" cols="30" rows="10" placeholder="Tekst" required></textarea>
        <input type = "date" name = "Data" placeholder = "Data" required>
        <input type = "text" name = "Kategoria" placeholder = "Kategoria" required>
        <button class = "button" id = "Przycisk" type="submit" name="Post">+ Dodaj post</button>
    </form>
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
        textarea::placeholder{
            text-align: center;
            color: blue;
        }
        input::placeholder{
            text-align: center;
            color: blue;
        }
        </style>
        <?php
        error_reporting(0);
        $przyciskpost = $_POST['Post'];
        if(isset($przyciskpost)){
            $Tytul = $_POST['Tytul'];
            $textarea = $_POST['textarea'];
            $Autor = $_SESSION['nick'];
            $Data = $_POST['Data'];
            $Kategoria = $_POST['Kategoria'];
            $pol = new mysqli("localhost", "root", "", "baza");
            $sql  = mysqli_query($pol, "create table if not exists posty (
                ID int NOT NULL  AUTO_INCREMENT,
                tytul VARCHAR(20)  NOT NULL,
                tekst VARCHAR(400)  NOT NULL,
                autor VARCHAR(40)  NOT NULL,
                data date  NOT NULL,
                kategoria VARCHAR(20)  NOT NULL,
                PRIMARY KEY (ID)
              )");
            $pol->query("INSERT INTO posty (tytul, tekst, autor, data, kategoria) VALUES ('$Tytul', '$textarea', '$Autor', '$Data', '$Kategoria')");
            header('Location: index.php');
        }




?>
</body>
</html>