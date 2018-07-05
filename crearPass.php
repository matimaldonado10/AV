<?php

$password = 'gonza5309';
$passwordHash = password_hash($password, PASSWORD_DEFAULT);

echo "<br>";
echo ($password);
echo "<br>";
//print_r($registrosRepartidores);
echo ($passwordHash);
