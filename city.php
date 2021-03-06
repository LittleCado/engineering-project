<?php
require 'db.php';

function get_city_list($pdo)
{
    $stmt = $pdo->query('SELECT * FROM cities');
    while ($row = $stmt->fetch()) {
        echo "
            <div class=\"container__radio\">
                <input required id=\"city-" . $row['id'] . "\" type=\"radio\" name=\"city\" value=\"" . $row['city'] . "\"/>
                <label for=\"city-" . $row['id'] . "\">" . $row['city'] . "</label>
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
    <form class="container" action="hospital.php" method="post">
        <h1 class="container__header">Выберите город</h1>
        <?php get_city_list($pdo);

        //Передача данных введенных на предыдущей странице через post
        echo '<input type="hidden" name="polis" value="' . $_POST['polis'] . '">';
        echo '<input type="hidden" name="birthday" value="' . $_POST['birthday'] . '">';
        echo '<input type="hidden" name="customer_name" value="' . $_POST['customer_name'] . '">';
        ?>
        <button class="container__submit" type="submit">Далее</button>
    </form>
</main>
</body>
</html>