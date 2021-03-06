<?php
require 'db.php';

function quantity($pdo)
{
    $sql = $pdo->prepare("SELECT COUNT(id) as count FROM `times` WHERE booked = 0");
    $sql->execute();

    while ($row = $sql->fetch()) {
        echo $row['count'];
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
    <link rel="shortcut icon" href="img/icon.ico" />
</head>
<body>
<header class="header br">
    <div class="header__logo">
        <img class="header__img" src="img/logo.svg" alt="logo"/>
        <p class="header__text">Система электронной записи к врачу</p>
    </div>
    <div class="header__holder">
        <a href="admin_check.php" class="header__button">Изменить названия поликлиник</a>
        <a href="delete.php" class="header__button">Удалить запись</a>
    </div>
</header>
<main class="main">
    <div class="container">
        <h1 class="container__heading">Записей доступно: <?php quantity($pdo); ?></h1>
    </div>
    <form class="container" action="city.php" method="post">
        <label class="container__label" for="polis"
        >Полис ОМС <small>(16 цифр)</small></label
        >
        <input
                type="text"
                class="container__input"
                name="polis"
                id="polis"
                required
                pattern="[0-9]{16}"
                maxlength="16"
        />
        <label class="container__label" for="birthday">Дата рождения</label>
        <input
                class="container__input"
                type="date"
                name="birthday"
                id="birthday"
                max="2019-01-01"
                required
        />
        <label class="container__label" for="customer_name">ФИО</label>
        <input
                class="container__input"
                type="text"
                name="customer_name"
                id="customer_name"
                required
        />
        <button class="container__submit" type="submit">Далее</button>
    </form>
</main>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="js/jquery.iMissYou.js"></script>
<script>
    jQuery(document).ready(function ($) {
        $.iMissYou({
            title: "Вернитесь пожалуйстааа!",
            favicon: {
                enabled: true,
                src: "img/iMiss.ico",
            },
        });
    });
</script>
</html>