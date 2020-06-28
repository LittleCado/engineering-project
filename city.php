<?php
require 'db.php';

function get_city_list($pdo)
{
    $stmt = $pdo->query('SELECT * FROM cities');
    while ($row = $stmt->fetch()) {
        echo "
            <div class=\"container__radio\">
                <input id=\"city-". $row['id'] ."\" type=\"radio\" name=\"city\" value=\"" . $row['city'] . "\" checked/>
                <label for=\"city-". $row['id'] ."\">" . $row['city'] . "</label>
            </div>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Электронная запись к врачу</title>
    <link rel="stylesheet" href="css/main.css"/>
</head>
<body>
<header class="header br">
    <div class="header__logo">
        <img class="header__img" src="img/logo.svg" alt="logo"/>
        <p class="header__text">Система электронной записи к врачу</p>
    </div>
</header>
<main class="main">
    <form class="container">
        <h1 class="container__header">Выберите город</h1>
        <?php get_city_list($pdo);?>

        <button class="container__submit" type="submit">Далее</button>
    </form>
</main>
</body>
</html>