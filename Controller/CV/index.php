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
                $File=$dbcv->upAnh();

                $HoTen=trim($_POST['username']);
                $ViTri=trim($_POST['location']);
                $SoDienThoai=trim($_POST['phone']);
              //  $File=trim($_POST['file']);
                $Ngayapply=date("y-m-d h:i:s");
                $IdUser=$_SESSION['id_user'];
                if($dbcv->addcv($HoTen,$ViTri,$Ngayapply,$SoDienThoai,$File,$IdUser))
                {
                    echo '<script language="javascript">alert("Da apply thanh cong !!!"); window.location="index.php?Controller=user&Action=trangchu";</script>';
                }


            }


                




                        require_once 'View/Apply.php';
    
                        break;
            

            // if(isset($_POST['submitcv']))
            // {
            
           //     echo $_FILES["file"]["tmp_name"];
                


            //     $target_dir = "uploads/";
            //     $target_file = $target_dir . basename($_FILES["file"]["name"]);
            //     $uploadOk = 1;
            //     $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

            //     // Check if image file is a actual image or fake image
            // //    if(isset($_POST["submit"])) {
            //     $check = getimagesize($_FILES["file"]["tmp_name"]);
            //     if($check !== false) {
            //         echo "File is an image - " . $check["mime"] . ".";
            //         $uploadOk = 1;
            //     } else {
            //         echo "File is not an image.";
            //         $uploadOk = 0;
            //     }
            //   //  }

            //     // Check if file already exists
            //     if (file_exists($target_file)) {
            //     echo "Sorry, file already exists.";
            //     $uploadOk = 0;
            //     }

            //     // Check file size
            //     if ($_FILES["file"]["size"] > 500000) {
            //     echo "Sorry, your file is too large.";
            //     $uploadOk = 0;
            //     }

            //     // Allow certain file formats
            //     if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            //     && $imageFileType != "gif" ) {
            //     echo "Sorry, only JPG, jpeg, PNG & GIF files are allowed.";
            //     $uploadOk = 0;
            //     }

            //     // Check if $uploadOk is set to 0 by an error
            //     if ($uploadOk == 0) {
            //     echo "Sorry, your file was not uploaded.";
            //     // if everything is ok, try to upload file
            //     } else {
            //     if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
            //      //   echo "The file ". htmlspecialchars( basename( $_FILES["file"]["name"])). " has been uploaded.";
            //         $File=htmlspecialchars( basename( $_FILES["file"]["name"]));
            //     } else {
            //         echo "Sorry, there was an error uploading your file.";
            //     }
            //             }

            
            // }
            // require_once 'View/Apply.php';
            // break;
        case 'list':
            $CVS=array();
            $CVS=$dbcv->listCV();
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
                $NoiDung="Rat tiec , ban khong phu hop voi tieu chi cua cong ty chung toi , han hanh gap ban o lan hop tac sau , thanks";
                
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
                $NoiDung = "Chuc mung ban da ung tuyen thanh cong vao cong ty chung toi , thoi gian phong van cua ban la ngay ".$NgayPV." . Vui long dang nhap vao he thong va xac nhan truoc 6 gio so voi thoi diem phong van . Thanks ";

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