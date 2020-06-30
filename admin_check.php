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
        <label class="container__label" for="password"
        >Пароль админа <small>(12345)</small></label>
        <input
            type="password"
            class="container__input"
            name="password"
            id="password"
            required
        />
        <button class="container__submit" type="submit">Далее</button>
    </form>
    <?php
    if (isset($_POST['password']) && ($_POST['password'])=='12345'){
        echo '<a href="update.php">Перейти к изменению поликлиник</a>';
    } else if (isset($_POST['password']) && ($_POST['password'])!='12345'){
        echo '<h1>Пароль неверный</h1>';
    }
    ?>
</main>
</body>
</html>