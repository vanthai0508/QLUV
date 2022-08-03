<html>
    <head>

    </head>

    <div>
        <h1>Profile</h1>
        <?php print_r($cv);
        $homnay=$cv->NgayApply; 
        echo $homnay;
        $cenvertedTime = date('Y-m-d H:i:s',strtotime('-6 hour',strtotime($homnay)));
        echo $cenvertedTime;
        if (strtotime($homnay) < strtotime($cenvertedTime)) {
            echo "dung";
            } else {
            echo "sai";
            }

        
        
        ?>
        
    </div>
    <?php
      
    
    ?>
</html>