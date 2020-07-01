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

    <div class="container">
        <?php
        require 'db.php';

        $sql = $pdo->prepare("DELETE FROM recordings WHERE id = ?");
        $sql->execute([$_POST['rec_id']]);

        $sql = $pdo->prepare("UPDATE times SET booked = 0 WHERE id = ?");
        $sql->execute([$_POST['time_id']]);

        echo '<h1 class="container__header">Удалено</h1>
                <a href="index.php">Вернуться на главную</a>';
        ?>
    </div>
</main>
</body>
</html>

