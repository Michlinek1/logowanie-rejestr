<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wyloguj sie</title>
</head>
<body>
    <?php
    session_Start();

    if ($_SESSION['zalogowany'] == true) {
        $_SESSION['zalogowany'] = false;
        header('Location: index.php');
    }
    


    ?>
    
</body>
</html>
