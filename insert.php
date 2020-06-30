<?php
require 'db.php';

function insert($pdo)
{
    $sql = $pdo->prepare("INSERT INTO recordings (polis, birthday, doctor_id, customer_name, time_id, date_id)
                            VALUES (?, ?, ?, ?, ?, ?)");
    $sql->execute([$_POST['polis'], $_POST['birthday'], $_POST['doctor_id'], $_POST['customer_name'], $_POST['time_id'], $_POST['date_id']]);
}


function show_info($pdo)
{
    $sql = $pdo->prepare("UPDATE `times` SET `booked` = '1' WHERE times.id = ?;");
    $sql->execute([$_POST['time_id']]);

    echo "<h1 class=\"container__header\">Вы успешно записаны на прием</h1>";


    $sql = $pdo->prepare("SELECT id FROM `recordings`
                        WHERE time_id = ?");
    $sql->execute([$_POST['time_id']]);

    while ($row = $sql->fetch()) {
        echo "
            <p class=\"container__info\">
          Запишите номер вашей записи: " . $row['id'] . "
            </p>
      ";
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
    <div class="container">
    <?php
        insert($pdo);
        show_info($pdo);
    ?>
    </div>
</main>
</body>
</html>
