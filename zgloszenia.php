<?php
session_Start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zgłoś Błąd </title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="style.php" media="screen">
</head>
<body>
<nav>
    <ul>
       <?php
       if($_SESSION['zalogowany'] == true){
           echo "<li ><a class = 'pod' href = 'index.php'>Strona Główna</a></li>";
            echo "<li ><a class = 'active' href = 'zgloszenia.php'>Zgłoś Błąd</a></li>";
            echo "<li ><a class = 'pod' href = 'ustawienia.php'>Ustawienia</a></li>";
            echo "<li ><a class = 'pod' href='wyloguj.php'>Wyloguj</a></li>";
            echo "</ul>";
            echo " </nav>";
       }else{
            echo "<li ><a class = 'pod' href = 'index.php'>Strona Główna</a></li>";
            echo "<li ><a class = 'active' href = 'zgloszenia.php'>Zgłoś Błąd</a></li>";
            echo "<li><a class ='pod' href='logowanie.php' >Logowanie</a></li>";
            echo "<li><a class ='pod' href='rejestracja.php' >Rejestracja</a></li>";
            echo "</ul>";
            echo " </nav>";
       }




        ?>
    <h1 class = "tekst">Zgłoś Błąd</h1>
    <form method = "POST">
        <select name = "blad[]" id = "select" required>
        <option value = "" disabled selected hidden>Wybierz Błąd</option>
            <option value = "Nie mogę się zarejestrować">Nie mogę się zarejestrować</option>
            <option value = "Nie mogę się zalogować">Nie mogę się zalogować</option>
            <option value = "Nie mogę zmienić hasła / maila">Nie mogę zmienić hasła / maila</option>
            <option value = "Nie mogę dodać postu">Nie mogę dodać postu</option>
            <option value = "Nie mogę zobaczyc postów">Nie mogę zobaczyc postów</option>
            <option value = "Nie mogę stworzyć postów">Nie mogę stworzyć postów</option>
        </select>
        <textarea  id = "TextArea" name ="textarea" cols="30" rows="10" placeholder="Opisz błąd" required></textarea>
        <input type = "mail" name = "email" placeholder = "Podaj email" id = "input"required>
        <button class = "button" id = "Przycisk" type="submit" name="przyciskzglos">Zgłoś</button>
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
            font-size: 20px;
            color: blue;
        }
        #select{
            text-align: center;
            width: 100%;
            height: 50px;
            font-size: 20px;
            color: blue;
            
        }
        input{
            text-align: center;
            width: 100%;
            height: 50px;
        }
        </style>
<?php
$opcje = filter_input(INPUT_POST, 'blad', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
if(isset($_POST['przyciskzglos'])){
$do = $_POST['email'];
foreach($opcje as $o){
    $temat = "Zgłoszenie błędu"." - ". $o;
}
if($_SESSION['zalogowany'] == true){
    $tekst = "Wysłane przez:". " ".$_SESSION['nick']. "\n"."Opis:". " " .$_POST['textarea'];
}else{
    $randomid = substr(md5(rand()), 0, 7);
    $tekst = "Wysłane przez :". "Niezalogowany ID: $randomid"."\n" ."Opis:". " " .$_POST['textarea'];
}
    

$headers = "From: wonszuplayz@gmail.com";
$wysylanie = mail($do, $temat, $tekst, $headers);
echo($wysylanie ? "<h2 class = 'tekst'>Email został wysłany</h2>" : "<h2 class = 'tekst'>Email nie został wysłany</h2>");
    
}

?>
</body>
</html>