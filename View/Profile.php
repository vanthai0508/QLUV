<html>
    <head>

    </head>

    <div>
        <h1>Profile</h1>
        
    </div>
    <?php
        echo $_SESSION['id_user'];
        echo date("y-m-d h:i:s");
        $date=date("y-m-d h:i:s");
        $new=strtotime ( '+2 day' , strtotime ( $date ) ) ;
        $new = date ( 'y-m-d h:i:s' , $new );
        echo $new;
    
    ?>
</html>