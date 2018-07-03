<?php

$password = 'marce1485';
$passwordHash = password_hash($password, PASSWORD_DEFAULT);

echo "<br>";
echo ($password);
echo "<br>";
//print_r($registrosRepartidores);
echo ($passwordHash);
