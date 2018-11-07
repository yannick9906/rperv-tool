<?php
    /**
     * Created by PhpStorm.
     * User: yanni
     * Date: 11/7/2018
     * Time: 11:46 PM
     */

    ini_set("display_errors", "on");
    error_reporting(E_ALL & ~E_NOTICE);
    header("Content-Type: text/json");

    require_once '../../classes/PDO_Mysql.php'; //DB Anbindung
    require_once '../../classes/Official.php';
    require_once '../../classes/Club.php';
    require_once '../../classes/User.php';

    $user = \rperv\User::checkSession();

    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $gender = $_POST["gender"];
    $title = $_POST["title"];
    $birthday = $_POST["birthday"];
    $function = $_POST["function"];
    $clubID = $_POST["clubID"];

    if($firstname != "" && $lastname != "" && $gender != "" && $title != "" && $birthday != "" && $clubID != "" && $function != "") {
        \rperv\Official::create($firstname, $lastname, $gender, $title, $function, $birthday, $clubID);
        echo json_encode(["success" => true]);
    } else  echo json_encode(["success" => false, "error" => "missing fields"]);