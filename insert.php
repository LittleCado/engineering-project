<?php
require 'db.php';

$sql = $pdo->prepare("INSERT INTO recordings (polis, birthday, doctor_id, customer_name, time_id, date_id)
                            VALUES (?, ?, ?, ?, ?, ?)");
$sql->execute([$_POST['polis'], $_POST['birthday'], $_POST['doctor_id'], $_POST['customer_name'], $_POST['time_id'], $_POST['date_id']]);
