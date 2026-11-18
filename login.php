<?php
session_start();
require 'baza.php';

$blad = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $z = $pdo->prepare(
        'SELECT login, haslo_hash FROM uzytkownicy WHERE login = :login'
    );

    $z->execute(['login' => trim($_POST['login'] ?? '')]);
    $u = $z->fetch();

    if ($u && password_verify($_POST['haslo'] ?? '', $u['haslo_hash'])) {
        session_regenerate_id(true);
        $_SESSION['uzytkownik'] = $u['login'];
        header('Location: admin.php');
        exit;
    }

    $blad = 'Błędny login lub hasło.';
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logowanie – Szprycha</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <main class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">

                <h1 class="mb-4">Logowanie administratora</h1>

                <?php if ($blad): ?>
                    <div class="alert alert-danger" role="alert">
                        <?= htmlspecialchars($blad) ?>
                    </div>
                <?php endif; ?>

                <form method="post">
                    <p>
                        <label for="login">Login:</label>
                        <input class="form-control" type="text" id="login" name="login" required>
                    </p>

                    <p>
                        <label for="haslo">Hasło:</label>
                        <input class="form-control" type="password" id="haslo" name="haslo" required>
                    </p>

                    <button type="submit" class="btn btn-primary">Zaloguj się</button>
                </form>

                <p class="mt-3"><a href="index.php">Powrót na stronę główną</a></p>

            </div>
        </div>
    </main>
</body>
</html>