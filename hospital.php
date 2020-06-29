<?php
require 'db.php';

function get_hospital_list($pdo)
{
    $sql = $pdo->prepare("SELECT hospitals.id as hid, name, type, city FROM `hospitals` 
            JOIN types ON hospitals.type_id = types.id
            JOIN cities ON hospitals.city_id = cities.id
            WHERE city = ?");
    $sql->execute([$_POST['city']]);

    while ($row = $sql->fetch()) {
        echo "
            <div class=\"container__radio\">
                <input id=\"hospital-" . $row['hid'] . "\" type=\"radio\" name=\"hospital\" value=\"" . $row['name'] . "\"/>
                <label for=\"hospital-" . $row['hid'] . "\">
                " . $row['name'] . "
                <p class=\"container__caption\">" . $row['type'] . "</p>
                </label>
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
        <?php get_hospital_list($pdo);

        //Передача данных введенных на предыдущих страницах (index и city) через post
        echo '<input type="hidden" name="polis" value="' . $_POST['polis'] . '">';
        echo '<input type="hidden" name="birthday" value="' . $_POST['birthday'] . '">';
        echo '<input type="hidden" name="customer_name" value="' . $_POST['customer_name'] . '">';
        echo '<input type="hidden" name="city" value="' . $_POST['city'] . '">';
        ?>
        <button class="container__submit" type="submit">Далее</button>
    </form>
</main>
</body>
</html>