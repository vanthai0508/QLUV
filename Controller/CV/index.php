<?php 

    // include "PHPMailer/src/PHPMailer.php";
    // include "PHPMailer/src/Exception.php";
    // // include "PHPMailer/src/OAuth.php";
    // include "PHPMailer/src/OAuthTokenProvider.php";
    // include "PHPMailer/src/POP3.php";
    // include "PHPMailer/src/SMTP.php";


 
    // use PHPMailer\PHPMailer\PHPMailer;
    // use PHPMailer\PHPMailer\Exception;




    if(isset($_GET['Action']))
    {
        $Action=$_GET['Action'];
    }
    else 
        $Action='';

    switch ($Action)
    {
        case 'apply':
            if(isset($_POST['submitcv']))
            {
                $HoTen=trim($_POST['hoten']);
                $ViTri=trim($_POST['vitri']);
                $SoDienThoai=trim($_POST['sdt']);
                $File=trim($_POST['file']);
                $Ngayapply=date("y-m-d h:i:s");
                $IdUser=$_SESSION['id_user'];

                if($dbcv->addcv($HoTen,$ViTri,$Ngayapply,$SoDienThoai,$File,$IdUser))
                {
                    echo '<script language="javascript">alert("Da apply thanh cong !!!"); window.location="index.php?Controller=user&Action=trangchu";</script>';
                }
            }
            require_once 'View/Apply.php';
            break;
        case 'list':
            $cvs=array();
            $cvs=$dbcv->listCV();
            require_once('View/ListCV.php');
            break;
        case 'reject':
            if(isset($_GET['idcv']))
            {
                $IdCV=$_GET['idcv'];
                // $IdUser=$_GET['idcv'];
                // $user=array();
                // $user=$dbuser->userTheoId($IdUser);
           //     require 'PHPMailerAutoload.php';
              
                //ogkfhlptrhjjdikg;
                $CV=array();
                $CV=$dbcv->cvTheoID($IdCV);
                $USER=array();
                $USER=$dbuser->userTheoId($CV->Id_User);
                $dbcv->daDuyet($CV->Id_User);
                $NoiDung="Rất tiếc , bạn không phù hợp với tiêu chí của công ty chúng tôi , hân hạnh gặp bạn ở lần hợp tác sau , thanks";
                
               $dbuser->goiMail($USER->Email,$NoiDung);
                
                echo '<script language="javascript">alert("Da reject !!!"); window.location="index.php?Controller=cv&Action=list";</script>';
                
            }
        
            break;
        case 'approve':
            if(isset($_GET['idcv']))
            {
                $IdCV=$_GET['idcv'];
                $cv=array();
                $cv=$dbcv->cvTheoID($IdCV);
                $date=date('y-m-d h:i:s');
                $NgayPV=strtotime ( '+2 day' , strtotime ( $date) ) ;
                $USER=$dbuser->userTheoId($cv->Id_User);
                $NgayPV = date ( 'y-m-d h:i:s' , $NgayPV);
                $NoiDung = "Chucs mừng bạn đã thành công ưnngs tuyển vào công ty chúng tôi , thời gian phỏng vấn của bạn là ngày ".$NgayPV." . Vui lòng xác đăng nhập vào hệ thống và xác nhận trước 6 giờ so với thời điểm phỏng vấn . Thanks ";

                if($dbxn->addxn($cv->Id_User,$NgayPV,$IdCV,0))
                {
                    $dbcv->daDuyet($USER->Id_User);
                    $dbuser->goiMail($USER->Email,$NoiDung);
                    echo '<script language="javascript">alert("Da approve thanh cong !!!"); window.location="index.php?Controller=user&Action=trangchu";</script>'; 
                
                }


            }


            break;


    }
?>