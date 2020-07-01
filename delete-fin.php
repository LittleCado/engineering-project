<?php
require 'db.php';


//    $sql = $pdo->prepare("DELETE FROM recordings WHERE id = ?");
//    $sql->execute([$_POST['rec_id']]);

    echo 'от :' . $_GET['time_id'];
    $sql = $pdo->prepare("UPDATE times SET booked = 0 WHERE id = ?");
    $sql->execute([$_GET['time_id']]);

    echo $_GET['time_id'];
    echo '<h1 class="container__header">Удалено</h1>
                <a href="index.php">Вернуться на главную</a>';