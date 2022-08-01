<?php 
    if(isset($_GET['Action']))
    {
        $Action=$_GET['Action'];
    }
    else 
        $Action='';

    switch ($Action)
    {
        case 'apply':
            require_once 'View/Apply.php';
    }
?>