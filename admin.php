
<?php
require 'auth.php';
require 'baza.php';

$blad = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['akcja'] ?? '') === 'usun') {
    $id = filter_var($_POST['id'] ?? '', FILTER_VALIDATE_INT);

    if ($id !== false && $id > 0) {
        $z = $pdo->prepare('DELETE FROM uslugi WHERE id = :id');
        $z->execute(['id' => $id]);
    }

    header('Location: admin.php');
    exit;
}

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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="index.php">Szprycha – panel administratora</a>
            <a class="btn btn-outline-light btn-sm" href="wyloguj.php">Wyloguj się</a>
        </div>
    </nav>

    <div class="container">

        <h1>Witaj, admin</h1>

    <p>Jesteś zalogowany jako <?= htmlspecialchars($_SESSION['uzytkownik']) ?>.</p>

    <h2>Lista usług</h2>

    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nazwa</th>
                <th>Cena (zł)</th>
                <th>Akcje</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($cennik as $usluga): ?>
                <tr>
                    <td><?= $usluga['id'] ?></td>
                    <td><?= htmlspecialchars($usluga['nazwa']) ?></td>
                    <td><?= $usluga['cena'] ?></td>
                    <td>
                        <form method="post">
                            <input type="hidden" name="akcja" value="usun">
                            <input type="hidden" name="id" value="<?= $usluga['id'] ?>">
                            <button type="submit" class="btn btn-danger btn-sm">Usuń</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h2>Dodaj usługę</h2>

    <?php if ($blad): ?>
        <div class="alert alert-danger" role="alert">
        <?= htmlspecialchars($blad) ?>
        </div>
    <?php endif; ?>

    <form method="post">
        <input type="hidden" name="akcja" value="dodaj">

        <div class="row g-3 align-items-end">
            <div class="col-md-5">
                <label for="nazwa" class="form-label">Nazwa</label>
                <input class="form-control" id="nazwa" name="nazwa" required maxlength="100">
            </div>

            <div class="col-md-3">
                <label for="cena" class="form-label">Cena (zł)</label>
                <input class="form-control" id="cena" name="cena" type="number" min="1" required>
            </div>

            <div class="col-md-auto">
                <button type="submit" class="btn btn-primary">Dodaj</button>
            </div>
        </div>
    </form>

    </div>
</body>
</html>