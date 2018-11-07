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

    $athleteToDelete = \rperv\Athlete::fromAID(intval($_GET["id"]));

    if($athleteToDelete->getAID() != null) {
        $athleteToDelete->delete();
        echo json_encode(["success" => true]);
    } else
        echo json_encode(["error" => "ID unknown"]);