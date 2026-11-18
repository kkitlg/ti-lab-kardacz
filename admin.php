
<?php
require 'auth.php';
require 'baza.php';

$blad = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['akcja'] ?? '') === 'dodaj') {
    $nazwa = trim($_POST['nazwa'] ?? '');
    $cena = filter_var($_POST['cena'] ?? '', FILTER_VALIDATE_INT);

    if ($nazwa !== '' && strlen($nazwa) <= 400 && $cena !== false && $cena >= 1) {
        $z = $pdo->prepare('INSERT INTO uslugi (nazwa, cena) VALUES (:nazwa, :cena)');
        $z->execute([
            'nazwa' => $nazwa,
            'cena' => $cena
        ]);

        header('Location: admin.php');
        exit;
    } else {
        $blad = 'Podaj poprawną nazwę i cenę usługi.';
    }
}

$cennik = $pdo->query('SELECT * FROM uslugi ORDER BY id')->fetchAll();
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

    <h2>Lista usług</h2>

    <table border="1" cellpadding="8">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nazwa</th>
                <th>Cena (zł)</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($cennik as $usluga): ?>
                <tr>
                    <td><?= $usluga['id'] ?></td>
                    <td><?= htmlspecialchars($usluga['nazwa']) ?></td>
                    <td><?= $usluga['cena'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h2>Dodaj usługę</h2>

    <?php if ($blad): ?>
        <p><?= htmlspecialchars($blad) ?></p>
    <?php endif; ?>

    <form method="post">
        <input type="hidden" name="akcja" value="dodaj">

        <label for="nazwa">Nazwa</label>
        <input id="nazwa" name="nazwa" required maxlength="100">

        <label for="cena">Cena (zł)</label>
        <input id="cena" name="cena" type="number" min="1" required>

        <button type="submit">Dodaj</button>
    </form>

    <p><a href="wyloguj.php">Wyloguj się</a></p>

</body>
</html>