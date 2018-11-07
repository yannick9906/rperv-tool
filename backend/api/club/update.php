<?php
    /**
     * Created by PhpStorm.
     * User: yanni
     * Date: 11/7/2018
     * Time: 11:47 PM
     */


    ini_set("display_errors", "on");
    error_reporting(E_ALL & ~E_NOTICE);
    header("Content-Type: text/json");

    require_once '../../classes/PDO_Mysql.php'; //DB Anbindung
    require_once '../../classes/Club.php';
    require_once '../../classes/User.php';

    $user = \rperv\User::checkSession();

    $clubToEdit = \rperv\Club::fromClubID(intval($_POST["id"]));

    if($clubToEdit->getClubName() == '' or $clubToEdit->getClubName() == null) {
        echo json_encode(["success" => false, "error" => "club not found"]);
        exit();
    }

    if(isset($_POST["name"])) $clubToEdit->setClubName($_POST["name"]);
    if(isset($_POST["nameShort"])) $clubToEdit->setClubNameShort($_POST["nameShort"]);
    if(isset($_POST["city"])) $clubToEdit->setClubCity($_POST["city"]);

    $clubToEdit->saveChanges();
    echo json_encode(["success" => true]);