<?php
$firma = 'Szprycha';
$rok = date('Y');
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Szprycha - serwis rowerowy</title>
    <link rel="stylesheet" href="style.css">
    <script src="app.js" defer></script>
</head>
<body>

    <header class="site-header">
        <p class="logo">Szprycha</p>

        <button class="menu-toggle" aria-expanded="false">
            Menu
        </button>

        <nav class="menu">
            <a href="#uslugi">Usługi</a>
            <a href="#cennik">Cennik</a>
            <a href="#kontakt">Kontakt</a>
        </nav>

    </header>
        
    <main>

        <h1>Witamy w Pracowni Rowerowej Szprycha!</h1>

    <section id="uslugi">

        <h2>Nasze usługi</h2>

        <div class="cards">

        <article class="card">
            <img src="images/rower.jpg" alt="Niebieski rower górski">
            <p class="card-label card-label--empty">&nbsp;</p>
            <h3>Przegląd roweru</h3>
            <p>Kontrola stanu technicznego roweru.</p>
            <p class="card__price">od 120 zł</p>
        </article>

        <article class="card card--highlight">
            <img src="images/hamulec.jpg" alt="Hamulec tarczowy roweru">
            <p class="card-label">Najczęściej wybierane</p>
            <h3>Naprawa hamulców</h3>
            <p>Regulacja i wymiana elementów hamulcowych.</p>
            <p class="card__price">od 60 zł</p>
        </article>

        <article class="card">
            <img src="images/przerzutka.jpg" alt="Tylna przerzutka rowerowa">
            <p class="card-label card-label--empty">&nbsp;</p>
            <h3>Regulacja przerzutek</h3>
            <p>Regulacja mechanizmu zmiany biegów.</p>
            <p class="card__price">od 50 zł</p>
        </article>

    </div>

    </section>

    <section id="cennik">
        <h2>Nasz cennik</h2>

        <table>
        <thead>
            <tr>
                <th>Usługa</th>
                <th class="num">Cena</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td>Przegląd roweru</td>
                <td class="num">od 120 zł</td>
            </tr>

            <tr>
                <td>Naprawa hamulców</td>
                <td class="num">od 60 zł</td>
            </tr>

            <tr>
                <td>Regulacja przerzutek</td>
                <td class="num">od 50 zł</td>
            </tr>

            <tr>
                <td>Wymiana dętki</td>
                <td class="num">od 30 zł</td>
            </tr>
        </tbody>
    </table>

    </section>

    <footer id="kontakt">

        <h2>Kontakt</h2>

        <p><strong>Pracownia Rowerowa Szprycha</strong></p>
        <p>Adres: ul. Rowerowa 8, 85-000 Bydgoszcz</p>
        <p>Telefon: <a href="tel:+48777888999">777 888 999</a></p>
        <p>E-mail: <a href="mailto:kontakt@szprycha.example">kontakt@szprycha.example</a></p>

        <h3>Godziny otwarcia</h3>

        <p>Poniedziałek – piątek: 9:00-17:00</p>
        <p>Sobota: 9:00-13:00</p>
        <p>Niedziela: nieczynne</p>

        <p class="copyright">&copy; <?= $rok ?> <?= $firma ?>. Wszelkie prawa zastrzeżone.</p>

    </footer>

</body>
</html>