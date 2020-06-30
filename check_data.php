<?php
require 'db.php';

function show_entered_data($pdo)
{
    echo "<div class=\"container\">
            <h1 class=\"container__header\">Проверьте введенные данные</h1>";
    echo '      
        <p class="container__info">
          Город: ' . $_POST['city'] . '
        </p>';

    $sql = $pdo->prepare("SELECT name FROM `hospitals`
                        WHERE id = ?");
    $sql->execute([$_POST['hospital_id']]);

    while ($row = $sql->fetch()) {
        echo "
            <p class=\"container__info\">
          Поликлиника: " . $row['name'] . "
        </p>
      ";
    }
    echo '      
        <p class="container__info">
          Специализация: ' . $_POST['specialization'] . '
        </p>
      ';

    $sql = $pdo->prepare("SELECT name FROM `doctors`
                        WHERE id = ?");
    $sql->execute([$_POST['doctor_id']]);

    while ($row = $sql->fetch()) {
        echo "
            <p class=\"container__info\">
          Врач: " . $row['name'] . "
        </p>";
    }

    $sql = $pdo->prepare("SELECT date FROM `dates`
                        WHERE id = ?");
    $sql->execute([$_POST['date_id']]);

    while ($row = $sql->fetch()) {
        echo "
            <p class=\"container__info\">
          Дата: " . $row['date'] . "
        </p>";
    }
    $sql = $pdo->prepare("SELECT time FROM `times`
                        WHERE id = ?");
    $sql->execute([$_POST['time_id']]);

    while ($row = $sql->fetch()) {
        echo "
            <p class=\"container__info\">
          Время: " . $row['time'] . "
        </p>
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

    <?php show_entered_data($pdo); ?>

    <form class="container" action="insert.php" method="post">
        <?php
        //Передача данных введенных на предыдущих страницах (index, city, hospital, specialization, doctor, date) через post
        echo '<input type="hidden" name="polis" value="' . $_POST['polis'] . '">';
        echo '<input type="hidden" name="birthday" value="' . $_POST['birthday'] . '">';
        echo '<input type="hidden" name="customer_name" value="' . $_POST['customer_name'] . '">';
        echo '<input type="hidden" name="city" value="' . $_POST['city'] . '">';
        echo '<input type="hidden" name="hospital_id" value="' . $_POST['hospital_id'] . '">';
        echo '<input type="hidden" name="specialization" value="' . $_POST['specialization'] . '">';
        echo '<input type="hidden" name="doctor_id" value="' . $_POST['doctor_id'] . '">';
        echo '<input type="hidden" name="date_id" value="' . $_POST['date_id'] . '">';
        echo '<input type="hidden" name="time_id" value="' . $_POST['time_id'] . '">';
        ?>
        <button class="container__submit" type="submit">Записаться</button>
    </form>
</main>
</body>
</html>
