<?php
    /**
     * Created by PhpStorm.
     * User: yanni
     * Date: 04.10.2016
     * Time: 22:05
     */

    ini_set("display_errors", "on");
    error_reporting(E_ALL & ~E_NOTICE);
    header("Content-Type: text/json");

    require_once '../../classes/PDO_Mysql.php'; //DB Anbindung
    require_once '../../classes/User.php';

    $user = \rperv\User::checkSession();

    if(intval($_GET["id"]) == -1)
        $userToEdit = $user;
    else
        $userToEdit = \rperv\User::fromUID(intval($_GET["id"]));

    if($userToEdit->getUID() != null)
        echo json_encode($userToEdit);
    else
        echo json_encode(["error" => "ID unknown"]);