<!doctype html>
<html>
    <head>
        <title>Đăng kí</title>
        <link rel="stylesheet" href="Css/Apply.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Merriweather:300,400,400i|Noto+Sans:400,400i,700" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600" rel="stylesheet">
    </head>
    <body>
    <form name="xn" method="POST">
        <div class="to">
        
            <div class="form">
                
                <h2>XÁC NHẬN THAM GIA</h2>
                
                <i class="fab fa-app-store-ios"></i>
                <label style="margin-left: -150px;">Họ và tên</label>
                <input type="text" name="hoten" value="<?php echo $CV->HoTen; ?>" readonly="False">
                <label style="margin-left: -190px;">Vị trí</label>
                <input type="text" name="vitri" value="<?php echo $CV->ViTri; ?>" readonly="False"> 
                <label style="margin-left: -110px;">Ngày phỏng vấn</label>
                <input type="text" name="ngaypv" value="<?php echo $XN->NgayPV; ?>" readonly="False"> 
                <input id="submit" type="submit" name="xacnhan" value="Xác nhận">
                
            </div>  
                      
        </div>
    </form>     
    </body>
</html>