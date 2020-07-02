<?php
require 'db.php';

function get_times_list($pdo)
{
    $count=0;
    $sql = $pdo->prepare("SELECT times.id as time_id, time FROM `times` 
                            WHERE date_id = ? and booked = 0");
    $sql->execute([$_POST['date_id']]);

    while ($row = $sql->fetch()) {
        echo "
            <div class=\"container__radio\">
                <input required id=\"time-" . $row['time_id'] . "\" type=\"radio\" name=\"time_id\" value=\"" . $row['time_id'] . "\"/>
                <label for=\"time-" . $row['time_id'] . "\">" . $row['time'] . "</label>
            </div>";
        $count = $count+1;
    }
    if ($count==0){
        echo '<h1 class="container__header">Нет доступного для записи времени</h1>';
    }
}

function show_entered_data($pdo)
{
    echo '      
      <div class="container">
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

    <form class="container" action="check_data.php" method="post">
        <h1 class="container__header">Выберите удобное время</h1>

        <?php get_times_list($pdo);

        //Передача данных введенных на предыдущих страницах (index, city, hospital, specialization, doctor, date) через post
        echo '<input type="hidden" name="polis" value="' . $_POST['polis'] . '">';
        echo '<input type="hidden" name="birthday" value="' . $_POST['birthday'] . '">';
        echo '<input type="hidden" name="customer_name" value="' . $_POST['customer_name'] . '">';
        echo '<input type="hidden" name="city" value="' . $_POST['city'] . '">';
        echo '<input type="hidden" name="hospital_id" value="' . $_POST['hospital_id'] . '">';
        echo '<input type="hidden" name="specialization" value="' . $_POST['specialization'] . '">';
        echo '<input type="hidden" name="doctor_id" value="' . $_POST['doctor_id'] . '">';
        echo '<input type="hidden" name="date_id" value="' . $_POST['date_id'] . '">';
        ?>
        <button class="container__submit" type="submit">Далее</button>
    </form>
</main>
</body>
</html>
