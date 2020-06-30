<?php
require 'db.php';

function get_hospital_list($pdo)
{
    $sql = $pdo->prepare("SELECT id, name FROM `hospitals` ");
    $sql->execute();

    while ($row = $sql->fetch()) {
        echo "
            <div class=\"container__radio\">
                <input id=\"hospital-" . $row['id'] . "\" type=\"radio\" name=\"hospital_id\" value=\"" . $row['id'] . "\"/>
                <label for=\"hospital-" . $row['id'] . "\"> " . $row['name'] . "</label>
            </div>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Кабинет администратора</title>
    <link rel="stylesheet" href="css/main.css"/>
</head>
<body>
<header class="header br">
    <div class="header__logo">
        <img class="header__img" src="img/logo.svg" alt="logo"/>
        <p class="header__text">Кабинет администратора</p>
    </div>
</header>
<main class="main">

    <form class="container" action="" method="post">
        <h1 class="container__header">Нажмите на поликлинику название которой хотите изменить</h1>
        <?php get_hospital_list($pdo); ?>
        <label class="container__label" for="new_name">Введите новое название</label>
        <input
            type="text"
            class="container__input"
            name="new_name"
            id="new_name"
            required
        />
        <button class="container__submit" type="submit">Далее</button>
    </form>

    <?php
    if (isset($_POST['hospital_id'])){
        $sql = $pdo->prepare("UPDATE hospitals SET name = ? WHERE id = ?");
        $sql->execute([$_POST['new_name'], $_POST['hospital_id']]);
    } else {
        echo '<h1>Нажмите на поликлинику название которой хотите изменить</h1>';
    }
    ?>
</main>
</body>
</html>