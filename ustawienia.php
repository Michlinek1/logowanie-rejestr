<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ustawienia</title>
    <link rel="stylesheet" href="style.php" media="screen">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php
session_start();
error_reporting(1);

?>
  <nav>
    <ul>
       <li><a class ="pod" href="index.php" >Strona glowna</a></li>
       <li><a class ="active" href="#" >Ustawienia</a></li>
    </ul>
  </nav>
  <table>
      <tr>
          <th >Twój Login </th>
          <th>Twoje hasło </th> 
          <th>Twoje zdjęcie </th>
      </tr>
      <tr>
            <td><?php echo $_SESSION['nick']; ?></td>
            <td><?php echo $_SESSION['haslo']; ?></td>
            <td>
                <?php
                function zdjecie(){
                        $conn = new mysqli('localhost', 'root', '', 'baza');
                        $sql = "SELECT img FROM dane WHERE login = '".$_SESSION['nick']."'";
                        $result = $conn->query($sql);
                        $row = $result->fetch_assoc();
                        echo '<img src="data:image/jpeg;base64,'.base64_encode( $row['img'] ).'" height="100" width="100"/>';
                        echo "</td>" ;
                    }

                zdjecie();
             




                ?>
      </tr>
  </table>
<form action="" method="POST">
<input type = "text" name = "zmianalogin" placeholder="Zmień hasło">
<button type="submit" id="Przycisk" name="Przycisk">Zmień hasło</button>
<button type="submit" id="Przycisk" name="Przyciskusun" style = "background-color:red;">Usuń konto</button> 

</form>
<?php
if(isset($_POST['Przyciskusun'])){
    $pol = new mysqli("localhost", "root", "", "baza");
    $result=mysqli_query($pol, "DELETE FROM dane WHERE login = '$_SESSION[nick]'");
    echo "<h2 class='tekst'>Usunąłeś konto </h1>";
    session_destroy();
    header("Location: index.php");
}


?>
<?php
if(isset($_POST['Przycisk'])){
    if($_POST['zmianalogin']!="" && $_SESSION['haslo']!=$_POST['zmianalogin']){
        $pol = new mysqli("localhost", "root", "", "baza");
        $result=mysqli_query($pol, "SELECT * FROM dane WHERE login = '$_SESSION[nick]'");
        if ($result->num_rows>0) {
            while ($wiersz = $result->fetch_assoc()) {
                if($_SESSION["nick"]==$wiersz["login"]){
                    $pol->query("UPDATE dane SET haslo2 = '$_POST[zmianalogin]' WHERE login = '$_SESSION[nick]'");
                    $_SESSION['haslo'] = $_POST['zmianalogin'];
                    echo "<h2 class='tekst'>Zmieniłeś hasło pomyślnie </h2>";  
                    header("Refresh:0");

                }
            }
        }
    }else{
        echo "<h2 class='tekst'>Podaj nowe hasło </h1>";
    }
}


?>

</body>
</html>
