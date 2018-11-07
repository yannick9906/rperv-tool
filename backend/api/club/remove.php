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

    $clubToDelete = \rperv\Club::fromClubID(intval($_GET["id"]));

    if($clubToDelete->getClubID() != null) {
        $clubToDelete->delete();
        echo json_encode(["success" => true]);
    } else
        echo json_encode(["success" => false, "error" => "ID unknown"]);