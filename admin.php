<?php
require 'auth.php';
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel administratora – Szprycha</title>
</head>
<body>

    <h1>Witaj, admin</h1>

    <p>Jesteś zalogowany jako <?= htmlspecialchars($_SESSION['uzytkownik']) ?>.</p>

    <p><a href="wyloguj.php">Wyloguj się</a></p>

</body>
</html>