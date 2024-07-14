<?php
session_start();
$root = $_SERVER['DOCUMENT_ROOT'] . '/wildlife/';
if (isset($_SESSION['id'])) {
    header('Location: /wildlife/controllers/dashboard/');
} else {
    require $root . '/views/dashboard/pages/login/login.view.php';
}
