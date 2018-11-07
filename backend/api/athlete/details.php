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
    require_once '../../classes/Athlete.php';
    require_once '../../classes/Club.php';
    require_once '../../classes/User.php';

    $user = \rperv\User::checkSession();

    $athleteToView = \rperv\Athlete::fromAID(intval($_GET["id"]));

    if($athleteToView->getAID() != null)
        echo json_encode($athleteToView);
    else
        echo json_encode(["success" => false, "error" => "ID unknown"]);