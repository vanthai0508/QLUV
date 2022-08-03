<?php
    if(isset($_GET['Action']))
    {
        $Action=$_GET['Action'];
    }
    else 
        $Action='';

    switch($Action)
    {
        case 'trangchu':
            require_once('View/Trangchu.php');
            break;
        case 'dangnhap':
            if(isset($_POST['dangnhap']))
            {
                $TenDangNhap=trim($_POST['tendangnhap']);
                $MatKhau=trim($_POST['matkhau']);
                if($dbuser->kiemTra($TenDangNhap,$MatKhau)==1)
                {
                    $IdUser=array();
                    $IdUser=$dbuser->iduserTheoTenDN($TenDangNhap);
                    $_SESSION["id_user"]=$IdUser->Id_User;
                 
                    $_SESSION["role"]=$IdUser->Role;
                    
                    echo '<script language="javascript">alert("Thanh cong !!!"); window.location="index.php?Controller=user&Action=trangchu";</script>';
                }
            }
            require_once('View/Dangnhap.php');
            break;
        case 'add':
            if(isset($_POST['dangky']))
            {
                
                
                $TenDangNhap=trim($_POST['tendangnhap']);
                $MatKhau=trim($_POST['matkhau']);
                $Email=trim($_POST['email']);
            //   $dbuser->add($TenDangNhap,$MatKhau,$Email);
                if( $dbuser->kiemTraTDN($TenDangNhap)==1)
                {
                    echo '<script language="javascript">alert("Trung ten dang nhap !!!"); window.location="index.php?Controller=user&Action=add";</script>';
                }
                else
                {
                    if($dbuser->add($TenDangNhap,$MatKhau,$Email))
                        {
                            echo '<script language="javascript">alert("Thanh cong !!!"); window.location="index.php?Controller=user&Action=dangnhap";</script>';
                        }

                }
                

            }
            require_once('View/Dangky.php');
            break;
        case 'xacnhan';
            $IdUser=$_SESSION['id_user'];
            $XN=array();
            $XN=$dbxn->xacNhanChoUser($IdUser);
            if(empty($XN)==null)
            {
                $CV=array();
                $CV=$dbcv->cvTheoID($XN->Id_CV);

                if(isset($_POST['xacnhan']))
                {   
                    $homnay=date('Y-m-d H:i:s');
                    $NgayPV=$XN->NgayPV;
                    $NgayXN=date('Y-m-d H:i:s',strtotime('-6 hour',strtotime($NgayPV)));
                    if(strtotime($homnay)<=strtotime($NgayXN))
                    {
                        if($dbxn->xacnhan($XN->Id_XN))
                        {
                            echo '<script language="javascript">alert("Thanh cong !!!"); window.location="index.php?Controller=user&Action=trangchu";</script>';
                        }

                    }
                    else 
                    {
                        echo '<script language="javascript">alert("Đã quá thời hạn xác nhận !!!"); window.location="index.php?Controller=user&Action=trangchu";</script>';
                    }
                    
                }


            }
            

            
            require_once('View/Xacnhan.php');
            break;
        case 'profile':

            $cv=$dbcv->cvTheoID(3);
            require_once('View/Profile.php');
            break;
        case 'listuserthamgiapv':
            $user=array();
            $xns=array();
            $cv=array();
            $xns=$dbxn->listUserThamGiaPV();
            for($i=1;$i<=sizeof($xns);$i++)
            {
                $user[$i]=$dbuser->userTheoId($xns[$i]->Id_User);
                $cv[$i]=$dbcv->cvTheoID($xns[$i]->Id_CV);
            }

            require_once('View/Thamgiapv.php');
            break;
        default:
            require_once('View/trangchu.php');
    }


?>