<?php
    /**
     * Created by PhpStorm.
     * User: yanni
     * Date: 28.09.2016
     * Time: 20:00
     */

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    header("Content-Type: text/json");

    require_once("../../classes/User.php");
    require_once("../../classes/PDO_Mysql.php");

    $usernameToCheck = $_GET["username"];

    $exists = \rperv\User::doesUserNameExist($usernameToCheck);

    echo json_encode(["exists" => $exists]);