<html></html>
<?php


use ModelUser as GlobalModelUser;

    //session_start();
    if (isset($_GET['Controller'])){
        $Controller = $_GET['Controller'];
    }
    else{
        $Controller='';
    }

    switch($Controller)
    {
        case 'user':
            include ('Model/M_User.php');
            $dbuser=new ModelUser;
            $dbuser->connect();
            require_once('Controller/User/index.php');
            break;
        case 'cv':
            include ('Model/M_User.php');
            $dbuser=new ModelUser;
            $dbuser->connect();
            require_once('Controller/CV/index.php');
            break;
        default:
            require_once('Controller/User/index.php');
            break;
            

    }


?>