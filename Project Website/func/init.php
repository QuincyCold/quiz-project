<?php
session_start();
if(!isset($_SESSION['logged_in'])) {
    $_SESSION['logged_in'] = false;
}
// loads classes from classes dir
function classLoader($className) {
    include "classes/" . $className . ".php";
}
// autoloader calls classLoader whenever a class is used
spl_autoload_register('classLoader');
$db = new DB("localhost", "root", "", "itec_quiz_2022");
$conn = $db->getConn();

$message = [];

include "func/func.php";
