
<?php

if(isset($_GET['Zapomnialem'])){
    echo "<input type = 'mail' name = 'Zapomnialeminput'  placeholder = 'Wpisz swój e-mail'>";
    echo "<input type = 'mail' name = 'Zapomnialeminputlogin'  placeholder = 'Wpisz swój login'>";
    echo "<button type = 'submit' id = 'Przycisk' name = 'PrzyciskZapomnialem'>Wyślij</button>";
    echo "</form>";
    $mail = $_POST['Zapomnialeminput'];
    $login = $_POST['Zapomnialeminputlogin'];
    if(isset($_POST['PrzyciskZapomnialem'])){
        if(!$mail || !$login){
            echo "<h2 class = 'tekst'>Podaj poprawny adres e-mail albo login</h2>";
        }
        else{
            $pol = new mysqli("localhost", "root", "", "baza");
            $result=mysqli_query($pol, "SELECT email,login FROM dane WHERE email = '$mail' AND login = '$login '");
            if ($result->num_rows>0) {
                while ($wiersz = $result->fetch_assoc()) {
                    if($mail==$wiersz["email"] && $login==$wiersz["login"]){
                    $do = $mail;
                    $temat = "Twoje hasło";
                    $tekst = "Twoje hasło to: ".$randomhaslo;
                    $headers = "From: wonszuplayz@gmail.com";
                    $wysylanie = mail($do, $temat, $tekst, $headers);
                    echo($wysylanie ? "<h2 class = 'tekst'>Email został wysłany</h2>" : "<h2 class = 'tekst'>Email nie został wysłany</h2>");
                    $result=mysqli_query($pol, "UPDATE dane SET haslo2 = '$randomhaslo'  WHERE email = '$mail' AND login = '$login'");
                    

                    }
                }
            }
            else{
                echo "<h2 class = 'tekst'>Podany adres e-mail albo login nie istnieje w bazie</h2>";
            }
        } 
    }
}


?>