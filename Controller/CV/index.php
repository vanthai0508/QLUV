<?php 

    include "PHPMailer/src/PHPMailer.php";
    include "PHPMailer/src/Exception.php";
    // include "PHPMailer/src/OAuth.php";
    include "PHPMailer/src/OAuthTokenProvider.php";
    include "PHPMailer/src/POP3.php";
    include "PHPMailer/src/SMTP.php";


 
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;




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
                // $IdUser=$_GET['idcv'];
                // $user=array();
                // $user=$dbuser->userTheoId($IdUser);
           //     require 'PHPMailerAutoload.php';
                $mail=new PHPMailer(true);
                print_r($mail);
                try 
                {
        //Server settings
                    $mail->SMTPDebug = 0;                                 // Enable verbose debug output
                    $mail->isSMTP();                                      // Set mailer to use SMTP
                    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
                    $mail->SMTPAuth = true;                               // Enable SMTP authentication
                    $mail->Username = 'vanthai22756@gmail.com';                 // SMTP username
                    $mail->Password = 'ogkfhlptrhjjdikg';                           // SMTP password
                    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                    $mail->Port = 587;                                    // TCP port to connect to
     
                    //Recipients
                    $mail->setFrom('vanthai22756@gmail.com', 'Mailer');
                    $mail->addAddress('tranthai22756@gmail.com', 'thai');     // Add a recipient
                    //  $mail->addAddress('ellen@example.com');               // Name is optional
                    // $mail->addReplyTo('info@example.com', 'Information');
                    // $mail->addCC('cc@example.com');
                    // $mail->addBCC('bcc@example.com');
                
                    //Attachments
                    // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
                    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
                
                    //Content
                    $mail->isHTML(true);                                  // Set email format to HTML
                    $mail->Subject = 'Thư phản hổi từ MOR';
                    $mail->Body    = 'Rất tiếc , bạn không đủ điều kiện của chúng tôi , hẹn gặp bạn hợp tác ở lần sau';
                    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
                
                    $mail->send();
                    echo 'Message has been sent';
                }
                catch (Exception $e) 
                {
                    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
                }
                //ogkfhlptrhjjdikg;

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
                    echo '<script language="javascript">alert("Da approve thanh cong !!!"); window.location="index.php?Controller=user&Action=trangchu";</script>'; 
                
                }


            }


            break;


    }
?>