<?php 

    use PHPMailer\PHPMailer\PHPMailer;
   
    use PHPMailer\PHPMailer\Exception;
    
    require 'PHPMailer-master/src/Exception.php';
     require 'PHPMailer-master/src/PHPMailer.php';
     require 'PHPMailer-master/src/SMTP.php';
     require 'PHPMailer-master/src/POP3.php';
     require 'PHPMailer-master/src/OAuthTokenProvider.php';
   //  require 'phpmailer/PHPMailerAutoload.php';
//     require 'PHPMailerAutoload.php';
//     include APPPATH . "../storage/PHPMailer-master/src/PHPMailer.php";
// include APPPATH . "../storage/PHPMailer-master/src/Exception.php";
// include APPPATH . "../storage/PHPMailer-master/src/OAuth.php";
// include APPPATH . "../storage/PHPMailer-master/src/POP3.php";
// include APPPATH . "../storage/PHPMailer-master/src/SMTP.php";
 
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
                    echo '<script language="javascript">alert("Da apply thanh cong !!!"); window.location="index.php?Controller=user&Action=profile";</script>';
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
                // $IdUser=$_GET['idcv'];
                // $user=array();
                // $user=$dbuser->userTheoId($IdUser);
           //     require 'PHPMailerAutoload.php';
           $message = " This is testing message from my server";
            
           $mail = new PHPMailer(); // create a new object
           $mail->IsSMTP(); // enable SMTP
           $mail->Host = "smtp.gmail.com";
           $mail->SMTPDebug = 2; // debugging: 1 = errors and messages, 2 = messages only
           $mail->SMTPAuth = true; // authentication enabled
           $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
           $mail->Port = 25; // or 587
           $mail->IsHTML(true);
           $mail->SMTPOptions = array(
            'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
            )
            );
           $mail->Username = "vanthai22756@gmail.com"; // My gmail username
           $mail->Password = "2silverbullet"; // My Gmail Password
           $mail->SetFrom("tranthai22756@gmail.com");
           $mail->Subject = "Test Mail from my Server";
           $mail->Body = $message;
           $mail->AddAddress("tranthai22756@gmail.com");
            if($mail->Send())
               {
             print json_encode("SUCCESS");
         }
         else
         {
             echo "Mailer Error: " . $mail->ErrorInfo;
         
         }

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
                $NgayPV = date ( 'y-m-d h:i:s' , $NgayPV);
                if($dbxn->addxn($cv->Id_User,$NgayPV,$IdCV,0))
                {
                    echo '<script language="javascript">alert("Da approve thanh cong !!!"); window.location="index.php?Controller=user&Action=profile";</script>'; 
                
                }


            }


            break;


    }
?>