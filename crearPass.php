<?php

$password = 'us^W7yR$^BCcy9Dz748zFZM!93W76z#t#D&4!9*!';
$passwordHash = password_hash($password, PASSWORD_DEFAULT);

echo "<br>";
echo ($password);
echo "<br>";
//print_r($registrosRepartidores);
echo ($passwordHash);
