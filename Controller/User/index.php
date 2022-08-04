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
            require_once('View/home.php');
            break;
        case 'dangnhap':
            if(isset($_POST['login']))
            {
                $TenDangNhap=trim($_POST['username']);
                $MatKhau=trim($_POST['password']);
                if($dbuser->kiemTra($TenDangNhap,$MatKhau)==1)
                {
                    $IdUser=array();
                    $IdUser=$dbuser->iduserTheoTenDN($TenDangNhap);
                    $_SESSION["id_user"]=$IdUser->Id_User;
                 
                    $_SESSION["role"]=$IdUser->Role;
                    
                    echo '<script language="javascript">alert("Thanh cong !!!"); window.location="index.php?Controller=user&Action=trangchu";</script>';
                }
                else
                {
                    echo '<script language="javascript">alert("Sai tai khoan hoac mat khau !!!"); window.location="index.php?Controller=user&Action=dangnhap";</script>';
                }
            }
            require_once('View/login.php');
            break;
        case 'add':
            if(isset($_POST['register']))
            {
                
                
                $TenDangNhap=trim($_POST['username']);
                $MatKhau=trim($_POST['password']);
                $Email=trim($_POST['email']);
            //   $dbuser->add($TenDangNhap,$MatKhau,$Email);
                if( $dbuser->kiemTraTDN($TenDangNhap)==1)
                {
                    echo '<script language="javascript">alert("Trung ten dang nhap !!!"); window.location="index.php?Controller=user&Action=add";</script>';
                }
                else
                {
                    if (preg_match("/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/", $MatKhau, $matches)==false)
                    {
                        echo '<script language="javascript">alert("Mật khẩu phải có ít nhất 8 kí tự , có ít nhất một ký tự hoa , một ký tự thường , một chữ số và một ký tự đặc biệt !!!"); window.location="index.php?Controller=user&Action=add";</script>';
                    }
                    else
                    {
                        if($dbuser->checkEmail($Email)==1)
                        {
                            echo '<script language="javascript">alert("Trung email !!!"); window.location="index.php?Controller=user&Action=add";</script>';
                        }
                        else
                        {
                            if($dbuser->add($TenDangNhap,$MatKhau,$Email))
                                {
                                    echo '<script language="javascript">alert("Thanh cong !!!"); window.location="index.php?Controller=user&Action=dangnhap";</script>';
                                }

                        }

                    }
                    
                    

                }
                

            }
            require_once('View/register.php');
            break;
        case 'xacnhan';
            $IdUser=$_SESSION['id_user'];
            $XN=array();
            $XN=$dbxn->xacNhanChoUser($IdUser);
            
            if(empty($XN)==null)
            {
                $CV=array();
                //$CV=$dbcv->cvTheoID($XN->Id_CV);
                $CV=$dbcv->cvTheoID($XN->Id_CV);
    
                if(isset($_POST['confirm']))
                {   
                    $HomNay=date('Y-m-d H:i:s');
                    $NgayPV=$XN->NgayPV;
                    $NgayXN=date('Y-m-d H:i:s',strtotime('-6 hour',strtotime($NgayPV)));
                    if(strtotime($HomNay)<=strtotime($NgayXN))
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
            

            
            require_once('View/confirm.php');
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
            for($i = 1;$i <= sizeof($xns);$i ++ )
            {
                $user[$i]=$dbuser->userTheoId($xns[$i]->Id_User);
                $cv[$i]=$dbcv->cvTheoID($xns[$i]->Id_CV);
            }

            require_once('View/participation.php');
            break;
        case 'quenpass':
            if(isset($_POST['submitpass']))
            {
                $Username=trim($_POST['username']);
                $Email=trim($_POST['email']);
                $User=array();
                if($dbuser->checkUsername($Username)==0)
                {
                    echo '<script language="javascript">alert("Username không tồn tại  !!!"); window.location="index.php?Controller=user&Action=quenpass";</script>';
                }
                else
                {
                    $User=$dbuser->iduserTheoTenDN($Username);

                    if($User->Email!=$Email)
                    {
                        echo '<script language="javascript">alert("Email không phù hợp với username  !!!"); window.location="index.php?Controller=user&Action=quenpass";</script>';
                    }
                    else
                    {
                        $NoiDung="Mật khẩu tài khoản của bạn là *** ".$User->MatKhau." ***. Đừng quên tài khoản nữa nha !!!";
                        $dbuser->goiMail($User->Email,$NoiDung);
                        echo '<script language="javascript">alert("Đã gởi mật khẩu về email của bạn  !!!"); window.location="index.php?Controller=user&Action=dangnhap";</script>';
                    }

                }

                


            }

            require_once('View/pass.php');

            break;
        default:
            require_once('View/home.php');
    }


?>