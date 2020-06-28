<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Электронная запись к врачу</title>
    <link rel="stylesheet" href="css/main.css" />
</head>
<body>
<header class="header br">
    <div class="header__logo">
        <img class="header__img" src="img/logo.svg" alt="logo" />
        <p class="header__text">Система электронной записи к врачу</p>
    </div>
</header>
<main class="main">
    <form class="container">
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
            max="01-01-2019"
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

