<?php
require 'db.php';

function get_hospital_list($pdo)
{
    $sql = $pdo->prepare("SELECT doctors.id as docid, doctors.name as docname FROM `doctors` 
                            JOIN specializations ON doctors.specialization_id = specializations.id
                            JOIN hospitals ON doctors.hospital_id = hospitals.id
                            WHERE hospitals.id = ? and specialization = ?");
    $sql->execute([$_POST['hospital_id'], $_POST['specialization']]);

    while ($row = $sql->fetch()) {
        echo "
            <div class=\"container__radio\">
                <input required id=\"doctor-" . $row['docid'] . "\" type=\"radio\" name=\"doctor_id\" value=\"" . $row['docid'] . "\"/>
                <label for=\"doctor-" . $row['docid'] . "\">" . $row['docname'] . "</label>
            </div>";
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
      </div>';
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

    <form class="container" action="date.php" method="post">
        <h1 class="container__header">Выберите врача</h1>
        <?php get_hospital_list($pdo);

        //Передача данных введенных на предыдущих страницах (index, city, hospital, specialization) через post
        echo '<input type="hidden" name="polis" value="' . $_POST['polis'] . '">';
        echo '<input type="hidden" name="birthday" value="' . $_POST['birthday'] . '">';
        echo '<input type="hidden" name="customer_name" value="' . $_POST['customer_name'] . '">';
        echo '<input type="hidden" name="city" value="' . $_POST['city'] . '">';
        echo '<input type="hidden" name="hospital_id" value="' . $_POST['hospital_id'] . '">';
        echo '<input type="hidden" name="specialization" value="' . $_POST['specialization'] . '">';
        ?>
        <button class="container__submit" type="submit">Далее</button>
    </form>
</main>
</body>
</html>