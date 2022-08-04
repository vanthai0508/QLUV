<?php
    
   // namespace Model;

    //use mysqli;
    include "PHPMailer/src/PHPMailer.php";
    include "PHPMailer/src/Exception.php";
    // include "PHPMailer/src/OAuth.php";
    include "PHPMailer/src/OAuthTokenProvider.php";
    include "PHPMailer/src/POP3.php";
    include "PHPMailer/src/SMTP.php";


 
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    include_once('Model/E_User.php');
    class ModelUser
    {
        private $hostname='localhost';
        private $username='root';
        private $pass='';
        private $dbname='QLUV'; 
        private $conn=null;
        private $result=null;

        public function connect()
        {
           // $this->conn=new mysqli($this->hostname);
            $this->conn=new mysqli($this->hostname,$this->username,$this->pass,$this->dbname);
            if(!$this->conn)
            {
                echo "Ket noi that bai";
                exit();
            }
            else {
                mysqli_set_charset($this->conn,'utf8');
            }
            return $this->conn;
        }
    
        public function execute($sql)
        {   
            $this->connect();
            $this->result=$this->conn->query($sql);
            return $this->result;
        }
        public function add($TDN,$MK,$Email)
        {
            $sql="INSERT INTO user (Tendangnhap,Matkhau,Email,Role) values ('$TDN','$MK','$Email',1)";
            return $this->execute($sql);
        }
        public function kiemTra($TDN,$MK)
        {
            $sql="SELECT * FROM user WHERE Tendangnhap='$TDN' AND Matkhau='$MK'";
            $this->execute($sql);
            if($this->num_rows()==0)
            {
                $ktra=0;
            }
            else{
                $ktra=1;
            }
            return $ktra;
    
        }
        public function kiemTraTDN($TDN)
        {
            $sql="SELECT * FROM user WHERE Tendangnhap='$TDN'";
            $this->execute($sql);
            if($this->num_rows()==0)
            {
                $Ktra=0;
            }
            else{
                $Ktra=1;
            }
            return $Ktra;
    
        }
        public function iduserTheoTenDN($Ten)
        {
            $users=array();
            $users=$this->listUser();
            for($i=1;$i<=sizeof($users);$i++)
            {
                if($users[$i]->TenDangNhap==$Ten)
                {
                    return $users[$i];
                }
            }
        }
        public function userTheoId($id)
        {
            $users=array();
            $users=$this->listUser();
            for($i=1;$i<=sizeof($users);$i++)
            {
                if($users[$i]->Id_User==$id)
                {
                    return $users[$i];
                }
            }
        }
        public function listUser()
        {
       
            $sql="SELECT * FROM user ";
            $this->execute($sql);
          
            $users=array();
              
            $i=1;
            while($data=mysqli_fetch_array($this->result))
                {
                    $Id_User=$data['Id_User'];
                    $Ten=$data['Tendangnhap'];
                    $MatKhau=$data['Matkhau'];
                    $Email=$data['Email'];
                    $Role=$data['Role'];
              
                
                    $users[$i]=new EntityUser($Id_User,$Ten,$MatKhau,$Email,$Role);
                    $i++;
                }
            
        
            return $users;
        }
        public function num_rows()
        {
            if($this->result)
            {
                $num=mysqli_num_rows($this->result);
    
            }
            else {
                $num=0;
            }
            return $num;
        }
        public function goiMail($Nhan,$Noidung)
        {
            $mail=new PHPMailer(true);
        //    print_r($mail);
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
                $mail->setFrom('vanthai22756@gmail.com', 'M O R');
                $mail->addAddress($Nhan, 'thai');     // Add a recipient
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
                $mail->Body    = $Noidung;
                // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
            
                $mail->send();
            //    echo 'Message has been sent';
            }
            catch (Exception $e) 
            {
                echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
            }
        }
    }


?>