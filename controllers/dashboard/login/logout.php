<?php
session_start();
session_unset();
session_destroy();
$url = '/wildlife/controllers/dashboard/login/login.php';
header('Location: ' . $url);

?>