<?php

session_start();
if (!isset($_SESSION['auth'])) {
    header("Location: index.php");
}
require_once './repositorio_eleitor.php';

foreach($_POST as $key => $value) {
    echo "POST parameter '$key' has '$value'<br>";
}

exit();
