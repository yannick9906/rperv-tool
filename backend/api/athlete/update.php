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
    require_once '../../classes/Athlete.php';
    require_once '../../classes/Club.php';
    require_once '../../classes/User.php';

    $user = \rperv\User::checkSession();

    $athleteToEdit = \rperv\Athlete::fromAID(intval($_POST["id"]));

    if($athleteToEdit->getFirstname() == '' or $athleteToEdit->getFirstname() == null) {
        echo json_encode(["success" => false, "error" => "user not found"]);
        exit();
    }

    if(isset($_POST["firstname"])) $athleteToEdit->setFirstname($_POST["firstname"]);
    if(isset($_POST["lastname"])) $athleteToEdit->setLastname($_POST["lastname"]);
    if(isset($_POST["gender"])) $athleteToEdit->setGender($_POST["gender"]);
    if(isset($_POST["title"])) $athleteToEdit->setTitle($_POST["title"]);
    if(isset($_POST["birthday"])) $athleteToEdit->setBirthday($_POST["birthday"]);
    if(isset($_POST["clubID"])) $athleteToEdit->setClubID($_POST["clubID"]);

    $athleteToEdit->saveChanges();
    echo json_encode(["success" => true]);