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
    require_once '../../classes/Official.php';
    require_once '../../classes/Club.php';
    require_once '../../classes/User.php';

    $user = \rperv\User::checkSession();

    $officialToEdit = \rperv\Official::fromOID(intval($_POST["id"]));

    if($officialToEdit->getFirstname() == '' or $officialToEdit->getFirstname() == null) {
        echo json_encode(["success" => false, "error" => "user not found"]);
        exit();
    }

    if(isset($_POST["firstname"])) $officialToEdit->setFirstname($_POST["firstname"]);
    if(isset($_POST["lastname"])) $officialToEdit->setLastname($_POST["lastname"]);
    if(isset($_POST["gender"])) $officialToEdit->setGender($_POST["gender"]);
    if(isset($_POST["title"])) $officialToEdit->setTitle($_POST["title"]);
    if(isset($_POST["birthday"])) $officialToEdit->setBirthday($_POST["birthday"]);
    if(isset($_POST["function"])) $officialToEdit->setFunction($_POST["function"]);
    if(isset($_POST["clubID"])) $officialToEdit->setClubID($_POST["clubID"]);

    $officialToEdit->saveChanges();
    echo json_encode(["success" => true]);