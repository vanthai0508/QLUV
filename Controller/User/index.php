<?php
    if(isset($_GET['Action']))
    {
        $Action=$_GET['Action'];
    }
    else 
        $Action='';

    switch($Action)
    {
        case 'dangnhap':
            if(isset($_POST['DangNhap']))
            {
                $TenDangNhap=trim($_POST['TenDangNhap']);
                $MatKhau=trim($_POST['MatKhau']);
                if($dbuser->ktrauserpass($TenDangNhap,$MatKhau)==1)
                {
                    echo '<script language="javascript">alert("Thanh cong !!!"); window.location="index.php?Controller=user&Action=profile";</script>';
                }
            }
            require_once('View/Dangnhap.php');
            break;
        case 'add':
            if(isset($_POST['DangKy']))
            {
                
                $TenDangNhap=trim($_POST['TenDangNhap']);
                $MatKhau=trim($_POST['MatKhau']);
                $Email=trim($_POST['Email']);
            //   $dbuser->add($TenDangNhap,$MatKhau,$Email);
                if($dbuser->add($TenDangNhap,$MatKhau,$Email))
                {
                    echo '<script language="javascript">alert("Thanh cong !!!"); window.location="index.php?Controller=user&Action=dangnhap";</script>';
                }

            }
            require_once('View/Dangky.php');
            break;
        case 'profile':
            require_once('View/Profile.php');
            break;
        default:
            require_once('View/Dangnhap.php');
    }


?>