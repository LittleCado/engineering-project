<?php
require 'db.php';

function show_entered_data($pdo)
{
    $count = 0;

    $sql = $pdo->prepare("SELECT recordings.id as rec_id, polis, birthday, doctors.name as dname, customer_name, time_id, date_id FROM `recordings`
                            JOIN doctors ON recordings.doctor_id = doctors.id
                            WHERE recordings.id = ?");
    $sql->execute([$_POST['rec_id']]);

    while ($row = $sql->fetch()) {
        echo '
        <p class="container__info">
          Полис: ' . $row['polis'] . '
        </p>
        
        <p class="container__info">
          День рождения: ' . $row['birthday'] . '
        </p>
        
        <p class="container__info">
          ФИО: ' . $row['customer_name'] . '
        </p>
        
        <p class="container__info">
          Доктор: ' . $row['dname'] . '
        </p>
        
        <p class="container__info">
          Дата: ' . $row['date_id'] . '
        </p>
        
        <p class="container__info">
          Время: ' . $row['time_id'] . '
        </p>
        ';
        $count = $count + 1;
    }
    if ($count==0){
        echo '<h1 class="container__header">Записи с таким номером нет</h1>';
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
    <form class="container" action="" method="post">
        <label class="container__label" for="rec_id">Введите номер вашей записи</label>
        <input
                type="text"
                class="container__input"
                name="rec_id"
                id="rec_id"
                required
        />
        <button class="container__submit" type="submit">Далее</button>
    </form>

    <div class="container">
        <?php
        if (isset($_POST['rec_id']) && !isset($_POST['del'])) {
            show_entered_data($pdo);
        }
        ?>

        <?php
        if (isset($_POST['del'])) {
            $sql = $pdo->prepare("DELETE FROM recordings WHERE id = ?");
            $sql->execute([$_POST['rec_id']]);
            echo '<h1 class="container__header">Удалено</h1>';
        } else {
            echo '<form method="POST">
                    <input class="container__submit" type="submit" name="del" value="Удалить"/>';
            echo '  <input type="hidden" name="rec_id" value="' . $_POST['rec_id'] . '">
                  </form>';
        }
        ?>
    </div>

</main>
</body>
</html>