
<?php
require 'baza.php';

// Tabela usług
$pdo->exec('CREATE TABLE IF NOT EXISTS uslugi (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nazwa TEXT NOT NULL,
    cena INTEGER NOT NULL
)');

// Tabela użytkowników
$pdo->exec('CREATE TABLE IF NOT EXISTS uzytkownicy (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    login TEXT NOT NULL UNIQUE,
    haslo_hash TEXT NOT NULL
)');

// Dodanie czterech usług, jeśli tabela jest pusta
$liczba = $pdo->query('SELECT COUNT(*) FROM uslugi')->fetchColumn();

if ($liczba == 0) {
    $z = $pdo->prepare(
        'INSERT INTO uslugi (nazwa, cena) VALUES (:nazwa, :cena)'
    );

    $uslugi = [
        ['nazwa' => 'Przegląd roweru', 'cena' => 120],
        ['nazwa' => 'Naprawa hamulców', 'cena' => 60],
        ['nazwa' => 'Regulacja przerzutek', 'cena' => 50],
        ['nazwa' => 'Wymiana dętki', 'cena' => 30]
    ];

    foreach ($uslugi as $usluga) {
        $z->execute($usluga);
    }
}

// Utworzenie konta administratora, jeśli tabela jest pusta
$liczba = $pdo->query('SELECT COUNT(*) FROM uzytkownicy')->fetchColumn();

if ($liczba == 0) {
    $z = $pdo->prepare(
        'INSERT INTO uzytkownicy (login, haslo_hash)
         VALUES (:login, :hash)'
    );

    $z->execute([
        'login' => 'admin',
        'hash' => password_hash('TwojeHaslo', PASSWORD_DEFAULT)
    ]);
}

echo 'Baza gotowa.';